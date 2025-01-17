<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditCategoryRequest;
use App\Http\Requests\SaveCategoryRequest;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function viewCategories():Response
    {
        //get categories
        $categories = Kategori::all();

        return \response()->view('categories',[
            'title'=>'Kategori',
            'categories'=>$categories
        ]);
    }

    public function saveCategory(SaveCategoryRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $kategori = new Kategori($data);
        $kategori->save();

        return response()->redirectTo('/categories')
            ->with('success','Kategori berhasil ditambahkan');
    }

    public function editCategory(EditCategoryRequest $request, $id): RedirectResponse
    {
        //check category
        $kategori = Kategori::query()->find($id);
        if (!$kategori) {
            return \response()->redirectTo('/categories')
                ->with('error','Kategori tidak ditemukan');
        }

        $data = $request->validated();
        $kategori->nama_kategori = $data['nama_kategori'];
        $kategori->save();

        return response()->redirectTo('/categories')
            ->with('success','Kategori berhasil diubah');
    }

    public function deleteCategory($id):RedirectResponse
    {
        //check category
        $kategori = Kategori::query()->find($id);
        if (!$kategori) {
            return \response()->redirectTo('/categories')
                ->with('error','Kategori tidak ditemukan');
        }
        $kategori->delete();

        return response()->redirectTo('/categories')
            ->with('success','Kategori berhasil dihapus');
    }

    public function viewDetailCategory(Request $request,$id): Response | RedirectResponse
    {
        $kategori = Kategori::query()->find($id);
        if (!$kategori) {
            return \response()->redirectTo('/categories')
                ->with('error','Kategori tidak ditemukan');
        }

        $keyStatus = $request->query('status','bisa dijual');

        if ($keyStatus === 'all'){
            $products = $kategori->produk;
        }else{
            $s = Status::query()->firstWhere('nama_status',$keyStatus);
            $products = $s ? $kategori->produk()->where('status_id',$s->id_status)->get() :collect();
        }

        $categories = Kategori::all();
        $status = Status::all();

        return response()->view('detail_category',[
            'title'=>'Detail Kategori: '.$kategori->nama_kategori,
            'category'=>$kategori,
            'products'=>$products,
            'categories'=>$categories,
            'status'=>$status,
        ]);
    }

}
