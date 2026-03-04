<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentNotificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $payload = $request->all();
        Log::info('Webhook Received', $payload);

        $orderId = $payload['order_id'];
        $transactionStatus = $payload['transaction_status'];
        $paymentType = $payload['payment_type'];

        if (!$orderId) {
            return response()->json(['message' => 'Order ID is missing'], 400);
        }

        $order = Order::where('invoice_number', $orderId)->firstOrFail();

        $signatureKeyValid = $this->validateSignatureKey($payload, env('MIDTRANS_SERVER_KEY'));
        if (!$signatureKeyValid) {
            Log::error('Invalid Midtrans Signature', ['order_id' => $orderId]);

            return response()->json(['message' => 'Invalid signature key'], 403);
        }

        Log::info('Processing Order', ['order_id' => $orderId, 'transaction_status' => $transactionStatus]);

        $order->status = $this->determineOrderStatus($transactionStatus);

        if ($paymentType) {
            $order->payment_method = $paymentType;
        }

        if ($order->isDirty()) {
            $order->save();
            Log::info('Order Updated via Webhook', ['order_id' => $orderId, 'new_status' => $order->status]);
        } else {
            Log::info('Order state unchanged (already up to date).', ['order_id' => $orderId]);
        }

        return response()->json(['message' => 'Webhook processed successfully']);
    }

    private function validateSignatureKey(array $payload, string $serverKey)
    {
        $orderId = $payload['order_id'];
        $statusCode = $payload['status_code'];
        $grossAmount = $payload['gross_amount'];
        $computedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        return $computedSignature === $payload['signature_key'];
    }

    private function determineOrderStatus(string $transactionStatus)
    {
        switch ($transactionStatus) {
            case 'capture':
            case 'settlement':
                return 'paid';
            case 'pending':
                return 'pending';
            case 'deny':
            case 'failure':
                return 'failed';
            case 'cancel':
                return 'cancelled';
            case 'expire':
                return 'expired';
            default:
                Log::warning('Unknown transaction status', ['status' => $transactionStatus]);
                return null;
        }
    }
}
