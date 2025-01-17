@include('partials.header')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('partials.sidebar',['active'=>'categories'])

        <!-- Main Content -->
        <div class="col-md-10">
            <div class="container py-3">
                <h6 style="text-align: right">{{now('Asia/Jakarta')->isoFormat('dddd, D MMMM YYYY')}}</h6>

                <h2>Kategori</h2>

                <!-- Category Section -->
                <div id="categories" class="mt-4">
                    <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal"
                            data-bs-target="#addCategoryModal">
                        Tambah Kategori</button>
                    @include('modal.add_category')

                    {{-- Table Categories --}}
                    <table class="table table-striped table-hover sortable">
                        <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Banyak Produk</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$category->nama_kategori}}</td>
                                    <td>{{$category->produk()->count()}}</td>

                                    <td>
                                        <a class="btn btn-sm btn-info" href="/categories/{{$category->id_kategori}}/detail">detail</a>
                                        <button class="btn btn-sm btn-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editCategoryModal{{$category->id_kategori}}">
                                            Edit</button>
                                        @include('modal.edit_category')

                                        <button class="btn btn-sm btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteCategoryModal{{$category->id_kategori}}">
                                            Hapus</button>
                                        @include('modal.delete_category')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')

