<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
        ]);

        User::factory()->create([
            'name' => 'user',
            'email' => 'user@example.com',
            'role' => 'customer'
        ]);
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
        ]);

        $randomProducts = Product::inRandomOrder()->take(5)->get();

        foreach ($randomProducts as $product) {
            Cart::factory()->create([
                'user_id' => 1, // customer
                'product_id' => $product->id,
            ]);
        }
    }
}
