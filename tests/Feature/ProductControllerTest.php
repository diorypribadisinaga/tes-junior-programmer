<?php

namespace Tests\Feature;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Status;
use Database\Seeders\KategoriSeeder;
use Database\Seeders\ProdukSeeder;
use Database\Seeders\StatusSeeder;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    private array $categories;
    private array $status;
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        DB::table('kategori')->delete();
        DB::table('status')->delete();
        DB::table('produk')->delete();

        $this->seed([KategoriSeeder::class,StatusSeeder::class]);

        $this->categories = Kategori::all()->toArray();
        $this->status = Status::all()->toArray();
    }

    public function testViewProducts(): void
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
        $response->assertViewIs('products');
        $response->assertViewHas('title','Produk');
        $response->assertViewHas('products');
    }

    public function testSaveProductSuccess(): void
    {
        $response = $this->post('/products',[
            'nama_produk' => 'Produk 1',
            'harga' => 100000,
            'kategori_id' => $this->categories[0]['id_kategori'],
            'status_id' => $this->status[1]['id_status'],
        ]);

        $response->assertRedirect('/products');
        $response->assertSessionHas('success','Produk berhasil ditambahkan');
    }

    public static function dataValidationFailed():array{
        return [
           [
               'data'=>[
                   'nama_produk' => '',
                   'harga' => 100000,
                   'kategori_id' => 1,
                   'status_id' => 2,
               ],
               'missing'=>'nama_produk'
           ],
            [
               'data'=>[
                   'nama_produk' => 'Produk 1',
                   'harga' => -2,
                   'kategori_id' => 1,
                   'status_id' => 2,
               ],
               'missing'=>'harga'
           ],
            [
               'data'=>[
                   'nama_produk' => 'Produk 1',
                   'harga' => -2,
                   'kategori_id' => '',
                   'status_id' => 2,
               ],
               'missing'=>'kategori_id'
           ],
            [
               'data'=>[
                   'nama_produk' => 'Produk 1',
                   'harga' => -2,
                   'kategori_id' => 1,
                   'status_id' => 'sa',
               ],
               'missing'=>'status_id'
           ],
        ];
    }

    #[DataProvider('dataValidationFailed')]
    public function testSaveProductFailedValidation(array $data, string $missing):void
    {
        $response = $this->post('/products',$data);

        $response->assertStatus(302);
        $response->assertSessionHas('errors');
        $response->assertSessionHasErrors([$missing]);
    }

    public function testSaveProductFailedCategoryNotFound(): void
    {
        $response = $this->post('/products',[
            'nama_produk' => 'Produk 1',
            'harga' => 100000,
            'kategori_id' => 'not-found',
            'status_id' => $this->status[1]['id_status'],
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('errors');
        $response->assertSessionHasErrors(['kategori_id']);
    }

    public function testSaveProductFailedStatusNotFound(): void
    {
        $response = $this->post('/products',[
            'nama_produk' => 'Produk 1',
            'harga' => 100000,
            'kategori_id' => $this->categories[0]['id_kategori'],
            'status_id' => 'not-found',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('errors');
        $response->assertSessionHasErrors(['status_id']);
    }

    public function testEditProductSuccess():void
    {
        $this->seed([ProdukSeeder::class]);
        $produk = Produk::query()->first();

        $response = $this->put("/products/{$produk->id_produk}/edit",[
            'nama_produk' => 'Produk 3',
            'harga' => 200000,
            'kategori_id' => $this->categories[1]['id_kategori'],
            'status_id' => $produk->status_id,
        ]);
        $response->assertRedirect('/products');
        $response->assertSessionHas('success','Produk berhasil diubah');
    }

    public function testEditProductFailNotFound()
    {
        $response = $this->put("/products/233/edit",[
            'nama_produk' => 'Produk 3',
            'harga' => 200000,
            'kategori_id' => $this->categories[1]['id_kategori'],
            'status_id' => $this->status[0]['id_status'],
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('error','Produk tidak ditemukan');
    }

    #[DataProvider('dataValidationFailed')]
    public function testEditProductFailValidation(array $data, string $missing)
    {
        $this->seed([ProdukSeeder::class]);
        $produk = Produk::query()->first();

        $response = $this->put("/products/{$produk->id_produk}/edit",$data);

        $response->assertStatus(302);
        $response->assertSessionHas('errors');
        $response->assertSessionHasErrors([$missing]);
    }

    public function testDeleteProductSuccess()
    {
        $this->seed([ProdukSeeder::class]);
        $produk = Produk::query()->first();

        $response = $this->delete("/products/{$produk->id_produk}/delete");

        $response->assertRedirect('/products');
        $response->assertSessionHas('success','Produk berhasil dihapus');
    }

    public function testDeleteProductFailNotFound()
    {
        $response = $this->delete("/products/243/delete");

        $response->assertRedirect('/products');
        $response->assertSessionHas('error','Produk tidak ditemukan');
    }

}
