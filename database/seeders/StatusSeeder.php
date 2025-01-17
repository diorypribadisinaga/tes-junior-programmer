<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $filesystem = Storage::disk('data');
        $data = json_decode($filesystem->get('products.json'),true);
        $products = collect($data['data']);

        // get status (filter with unique collection)
        $status = $products->unique('status')->select('status');

        $status->each(function ($s) {
            $status = new Status();
            $status->nama_status = $s['status'];
            $status->save();
        });
    }
}
