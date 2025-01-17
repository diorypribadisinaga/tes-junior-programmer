@include('partials.header')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('partials.sidebar',['active'=>'products'])

        <!-- Main Content -->
        <div class="col-md-10">
            <div class="container py-3">
                <h6 style="text-align: right">{{now('Asia/Jakarta')->isoFormat('dddd, D MMMM YYYY')}}</h6>
                <h2>Produk</h2>
                <!-- Product Section -->
                <div id="products" class="mt-4">
                    <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal"
                            data-bs-target="#addProductModal">
                        Tambah Produk</button>

                    <div class="d-flex justify-content-between">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pilih status
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/products?status=all">Semua</a></li>
                                @foreach($status as $s)
                                    <li><a class="dropdown-item" href="{{route('view.products',['status'=>$s->nama_status])}}">{{$s->nama_status}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <form action="/products/search" class="w-50" method="get">
                            <input name="keyword" type="text" class="form-control form-control"
                                   placeholder="Cari produk disini (tambahkan #all menampilkan semua)" aria-label="Cari produk" aria-describedby="basic-addon2">
                        </form>
                    </div>

                    @include('modal.add_product')

                    {{-- Table Products --}}
                    <table class="table table-striped table-hover mt-3 sortable">
                        <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$loop->iteration }}</td>
                                    <td>{{$product->nama_produk}}</td>
                                    <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                    <td>{{$product->kategori->nama_kategori}}</td>
                                    <td>{{$product->status->nama_status}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editProductModal{{$product->id_produk}}">
                                            Edit</button>
                                        @include('modal.edit_product')

                                        <button class="btn btn-sm btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteProductModal{{$product->id_produk}}">
                                            Hapus</button>
                                        @include('modal.delete_product')
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

