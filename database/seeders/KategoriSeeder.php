<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filesystem = Storage::disk('data');
        $data = json_decode($filesystem->get('products.json'),true);
        $products = collect($data['data']);

        // get categories (filter with unique collection)
        $categories = $products->unique('kategori')->select('kategori');

        $categories->each(function ($category) {
            $kategori = new Kategori();
            $kategori->nama_kategori = $category['kategori'];
            $kategori->save();
        });
    }
}
