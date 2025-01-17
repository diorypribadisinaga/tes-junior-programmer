<?php

namespace Tests\Feature;

use App\Models\Kategori;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CategorySeedTest extends TestCase
{
    public function testCategorySeed(): void
    {
        $filesystem = Storage::disk('data');
        $data = json_decode($filesystem->get('products.json'),true);
        $products = collect($data['data']);

        // get categories (filter with unique collection)
        $categories = $products->unique('kategori')->select('kategori');

        $categories->each(function ($category) {
            $kategori = new Kategori();
            $kategori->nama_kategori = $category['kategori'];
            $result = $kategori->save();
            $this->assertTrue($result);
        });
        $this->assertNotSameSize($products,$categories);
    }
}
