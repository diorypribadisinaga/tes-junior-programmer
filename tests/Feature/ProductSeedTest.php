<?php

namespace Tests\Feature;

use App\Models\Kategori;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductSeedTest extends TestCase
{
    public function testProductSeed(): void
    {
        $filesystem = Storage::disk('data');
        $data = json_decode($filesystem->get('products.json'),true);
        $products = collect($data['data']);

        $products->each(function ($product) {
            //Find category
            $kategori = Kategori::query()->firstWhere('nama_kategori',$product['kategori']);
            $this->assertNotNull($kategori);

            $status = Status::query()->firstWhere('nama_status',$product['status']);
            $this->assertNotNull($status);
        });
    }
}
