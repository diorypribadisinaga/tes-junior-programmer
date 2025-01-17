<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filesystem = Storage::disk('data');
        $data = json_decode($filesystem->get('products.json'),true);
        $products = collect($data['data']);

        $products->each(function ($product) {
            //Find category
            $kategori = Kategori::query()->firstWhere('nama_kategori',$product['kategori']);
            $status = Status::query()->firstWhere('nama_status',$product['status']);

            $produk = new Produk();
            $produk->nama_produk = $product['nama_produk'];
            $produk->harga = $product['harga'];
            $produk->kategori_id = $kategori->id_kategori;
            $produk->status_id = $status->id_status;

            $produk->save();
        });
    }
}
