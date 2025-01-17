<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StatusSeedTest extends TestCase
{
    public function testStatusSeed(): void
    {
        $filesystem = Storage::disk('data');
        $data = json_decode($filesystem->get('products.json'),true);
        $products = collect($data['data']);

        // get status (filter with unique collection)
        $status = $products->unique('status')->select('status');

        $this->assertCount(2,$status);
    }
}
