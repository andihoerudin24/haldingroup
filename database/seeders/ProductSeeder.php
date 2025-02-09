<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name'        => 'Organic Carrot',
                'description' => 'Wortel organik segar dari petani lokal, kaya akan vitamin dan serat.',
                'price'       => 3.50,
                'stock'       => 100,
                'image'       => 'https://media.istockphoto.com/id/160356158/id/foto/buah-buahan-dan-sayuran-dalam-kotak-kayu-dengan-latar-belakang-putih.jpg?s=612x612&w=0&k=20&c=pbvMMI9wMHWMc_Jh-iAC1dQJ0fWtQuuuGTPjmy6BDqY=',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Herbal Mint',
                'description' => 'Daun mint herbal yang menyegarkan, cocok untuk teh dan garnish.',
                'price'       => 1.50,
                'stock'       => 80,
                'image'       => 'https://media.istockphoto.com/id/182810893/id/foto/campuran-buah.jpg?s=1024x1024&w=is&k=20&c=-r2NjJLGQO7iBpuwwwD-yKZ1Wx9KGVwWiY6I4MbDwn0=',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Organic Spinach',
                'description' => 'Bayam organik kaya zat besi dan vitamin untuk gaya hidup sehat.',
                'price'       => 2.99,
                'stock'       => 120,
                'image'       => 'https://media.istockphoto.com/id/1247073860/id/foto/sayuran-organik-segar-yang-sehat-dalam-peti-yang-terisolasi-di-latar-belakang-putih.jpg?s=1024x1024&w=is&k=20&c=2xtQzGe6msH1W2SZ0gbJLhutbPvwGYbzP3JfT2Cuz44=',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Herbal Basil',
                'description' => 'Daun basil segar yang sempurna untuk berbagai hidangan kuliner.',
                'price'       => 2.50,
                'stock'       => 60,
                'image'       => 'https://media.istockphoto.com/id/1413587187/id/foto/buah-buahan-dan-sayuran-segar-berwarna-warni-dengan-latar-belakang-putih.jpg?s=1024x1024&w=is&k=20&c=lhWuzKYA7wt0UJJD_fTPmKFlAkgDzE6jRO_csyx76EA=',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Organic Tomato',
                'description' => 'Tomat organik yang juicy dengan rasa manis alami dan kaya nutrisi.',
                'price'       => 3.00,
                'stock'       => 90,
                'image'       => 'https://media.istockphoto.com/id/1413587187/id/foto/buah-buahan-dan-sayuran-segar-berwarna-warni-dengan-latar-belakang-putih.jpg?s=1024x1024&w=is&k=20&c=lhWuzKYA7wt0UJJD_fTPmKFlAkgDzE6jRO_csyx76EA=',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
