<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\SearchProductsRequest;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function viewProducts(Request $request):Response
    {
        //Get categories and status
        $categories = Kategori::all();
        $status = Status::all();

        $keyStatus = $request->query('status','bisa dijual');

        if ($keyStatus === 'all') {
            $products = Produk::all();
        }else{
            $s = Status::query()->firstWhere('nama_status',$keyStatus);
            $products = $s ? $s->produk : collect();
        }

        return response()->view('products',[
            'categories'=>$categories,
            'status'=>$status,
            'products'=>$products,
            'title'=>'Produk']);
    }

    public function saveProduct(ProductRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated(); //Validate and check category, status

        $produk = new Produk($data);
        $produk->save();

        return response()->redirectTo('/products')
            ->with('success','Produk berhasil ditambahkan');
    }

    public function editProduct(ProductRequest $request,$id): \Illuminate\Http\RedirectResponse
    {
        //Check product (is existed?)
        $produk = Produk::query()->find($id);
        if (!$produk) {
            return \response()->redirectTo('/products')
                ->with('error','Produk tidak ditemukan');
        }

        $data = $request->validated(); //Validate and check category, status

        $produk->nama_produk = $data['nama_produk'];
        $produk->harga = $data['harga'];
        $produk->kategori_id = $data['kategori_id'];
        $produk->status_id = $data['status_id'];
        $produk->save();

        return response()->redirectTo('/products')
            ->with('success','Produk berhasil diubah');
    }

    public function deleteProduct($id): RedirectResponse
    {
        //Check product (is existed?)
        $produk = Produk::query()->find($id);
        if (!$produk) {
            return \response()->redirectTo('/products')
                ->with('error','Produk tidak ditemukan');
        }

        $produk->delete();

        return response()->redirectTo('/products')
            ->with('success','Produk berhasil dihapus');
    }

    public function searchProducts(SearchProductsRequest $request):Response
    {
        $data = $request->validated();

        //Get categories and status
        $categories = Kategori::all();
        $status = Status::all();

        $keyword = $request->input('nama_produk');
        $statusKeyword = $request->input('nama_status');

        if (!$statusKeyword || $statusKeyword === 'all'){
            $products = Produk::query()
                ->where('nama_produk','like','%'.$keyword.'%')
                ->get();
        }else{
            $s = Status::query()->firstWhere('nama_status',$statusKeyword);
            $products = $s ?
                $s->produk()->where('nama_produk','like','%'.$keyword.'%')->get()
                :collect();
        }

        return \response()->view('products',[
            'categories'=>$categories,
            'status'=>$status,
            'products'=>$products,
            'title'=>'Cari Produk'
        ]);
    }


}
