<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriesAndProducts = [
            'Matic 110-125cc' => [
                [
                    'name' => 'Proliner TR-1 Short Honda Beat / Scoopy',
                    'description' => "Knalpot Proliner TR-1 Short. Material full stainless steel anti karat. Suara ngebass gahar (loud). Pemasangan Plug & Play (PNP) untuk Honda Beat FI, Scoopy FI, dan Genio. Dilengkapi DB Killer.",
                    'price' => 850000,
                    'stock' => 15,
                    'image' => 'products/proliner-tr1-beat.jpg'
                ],
                [
                    'name' => 'R9 Misano Honda Vario 125',
                    'description' => "R9 Misano Series. Desain elegan dengan pelindung panas (cover knalpot) berbahan plastik ABS kuat. Suara ngebass adem, ramah lingkungan dan aman tilang. PNP Vario 125 Old & New.",
                    'price' => 1100000,
                    'stock' => 10,
                    'image' => 'products/r9-misano-vario125.jpg'
                ],
                [
                    'name' => 'Kawahara GT Pro Honda Beat FI',
                    'description' => "Kawahara Racing GT Pro. Material plat galvanis tebal dengan finishing silencer aluminium CNC. Suara teriak di putaran atas, sangat cocok untuk balap matic atau harian.",
                    'price' => 750000,
                    'stock' => 8,
                    'image' => 'products/kawahara-gtpro-beat.jpg'
                ],
            ],

            'Matic 150-160cc' => [
                [
                    'name' => 'R9 Alpha Series Yamaha NMAX 155',
                    'description' => "R9 Alpha hadir dengan desain futuristik dan cover moncong silencer berbahan carbon kevlar asli. Suara padat dan tidak pecah di RPM tinggi. Tarikan motor langsung enteng.",
                    'price' => 1350000,
                    'stock' => 12,
                    'image' => 'products/r9-alpha-nmax.jpg'
                ],
                [
                    'name' => 'Daytona Evolution Exhaust Honda PCX 160',
                    'description' => "Daytona Evolution untuk PCX 160. Desain premium yang menyatu dengan body motor. Meningkatkan horse power hingga 1.5 HP. Suara ngebass bulat khas Daytona.",
                    'price' => 1450000,
                    'stock' => 5,
                    'image' => 'products/daytona-evo-pcx160.jpg'
                ],
                [
                    'name' => 'WRX GP6 Stainless Honda Vario 160',
                    'description' => "Knalpot WRX GP6 dengan panjang silencer 30cm. Cocok untuk mesin Vario 160 standar maupun bore up 180cc. Header menggunakan metode las cacing argon yang sangat rapi.",
                    'price' => 1600000,
                    'stock' => 7,
                    'image' => 'products/wrx-gp6-vario160.jpg'
                ],
                [
                    'name' => 'ROB1 Standard Racing Yamaha NMAX 155',
                    'description' => "Knalpot ROB1 bentuk standard bobok. Pilihan terbaik untuk rider yang ingin tampil kalem tapi suara gahar saat ditarik. Kualitas teruji di sirkuit maupun touring.",
                    'price' => 1550000,
                    'stock' => 14,
                    'image' => 'products/rob1-std-nmax.jpg'
                ],
            ],

            'Sport 150cc' => [
                [
                    'name' => 'Proliner TR-1 Long Yamaha R15 V3/V4',
                    'description' => "Proliner TR-1 Long. Silencer berukuran panjang untuk menjaga nafas mesin sport tetap stabil di top speed. Finishing sandblast titanium look.",
                    'price' => 950000,
                    'stock' => 9,
                    'image' => 'products/proliner-tr1long-r15.jpg'
                ],
                [
                    'name' => 'R9 H2 SS Series Honda CBR150R',
                    'description' => "Terinspirasi dari knalpot Kawasaki H2. R9 H2 SS memberikan tampilan super agresif. Material full stainless steel. Suara sangat garang dan keras (Racing Only).",
                    'price' => 1800000,
                    'stock' => 4,
                    'image' => 'products/r9-h2-cbr150r.jpg'
                ],
                [
                    'name' => 'WRX GP5 K2 Yamaha Vixion / R15',
                    'description' => "WRX Tipe GP5 K2 dirancang untuk torsi galak. Panjang silencer medium, memberikan kompromi sempurna antara akselerasi dan top speed.",
                    'price' => 1450000,
                    'stock' => 8,
                    'image' => 'products/wrx-gp5-vixion.jpg'
                ],
            ],

            'Sport 250cc' => [
                [
                    'name' => 'Proliner TR-2 Carbon Honda CBR250RR',
                    'description' => "Knalpot Proliner TR-2. Silencer dilapisi 100% Real Carbon Kevlar yang tahan panas dan sangat ringan. Pipa underbelly khusus desain CBR250RR.",
                    'price' => 3500000,
                    'stock' => 2,
                    'image' => 'products/proliner-tr2carbon-cbr250rr.jpg'
                ],
                [
                    'name' => 'Yoshimura R77 Slip-On Yamaha R25',
                    'description' => "Yoshimura R77 Slip-on. Pemasangan sangat mudah tanpa perlu mengganti header bawaan. Memberikan suara deep-bass yang sopan saat idle, dan gahar saat digeber.",
                    'price' => 4500000,
                    'stock' => 3,
                    'image' => 'products/yoshi-r77-r25.jpg'
                ],
            ],

            'Underbone / Trail' => [
                [
                    'name' => 'Proliner TR-1 Short Yamaha MX King 150',
                    'description' => "Pilihan favorit pengguna MX King / Y15ZR. Desain underbone racing look. Bobot super ringan hanya 1.5 kg (full system).",
                    'price' => 900000,
                    'stock' => 11,
                    'image' => 'products/proliner-tr1-mxking.jpg'
                ],
                [
                    'name' => 'R9 Misano Honda Supra GTR 150',
                    'description' => "Tingkatkan performa Supra GTR 150 dengan R9 Misano. Suara tidak berisik sehingga cocok untuk motor operasional harian bertenaga besar.",
                    'price' => 1150000,
                    'stock' => 7,
                    'image' => 'products/r9-misano-gtr.jpg'
                ],
                [
                    'name' => 'Norifumi Rocket 4 Honda CRF150L',
                    'description' => "Knalpot wajib anak trabasan. Norifumi Rocket 4 dirancang tahan banting, material tebal anti penyok. Suara blarr khas motor trail SE.",
                    'price' => 1650000,
                    'stock' => 10,
                    'image' => 'products/norifumi-rocket4-crf.jpg'
                ],
            ],
        ];

        // Looping untuk memasukkan data ke Database
        foreach ($categoriesAndProducts as $categoryName => $products) {
            $category = Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
            ]);

            foreach ($products as $product) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $product['name'],
                    'slug' => Str::slug($product['name']),
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'stock' => $product['stock'],
                    'image' => $product['image'],
                ]);
            }
        }
    }
}
