<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Menambahkan data contoh produk
        Product::create([
            'name' => 'Sepatu Sneakers Lustreco',
            'description' => 'Sepatu kasual elegan dan nyaman digunakan untuk aktivitas sehari-hari.',
            'price' => 250000,
            'stock' => 15,
            'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=500'
        ]);

        Product::create([
            'name' => 'Kaos Polos Oversize',
            'description' => 'Bahan katun combed 30s berkualitas tinggi, adem dan menyerap keringat.',
            'price' => 85000,
            'stock' => 30,
            'image' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?w=500'
        ]);

        Product::create([
            'name' => 'Jaket Denim Vintage',
            'description' => 'Jaket berbahan denim tebal dengan gaya klasik modern.',
            'price' => 320000,
            'stock' => 8,
            'image' => 'https://images.unsplash.com/photo-1576995853123-5a10305d93c0?w=500'
        ]);
    }
}