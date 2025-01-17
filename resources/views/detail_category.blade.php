@include('partials.header')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('partials.sidebar',['active'=>'categories'])

        <!-- Main Content -->
        <div class="col-md-10">
            <div class="container py-4">
                <h3>{{$category->nama_kategori}}</h3>
                <div class="dropdown">
                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pilih status
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('detailCategory',['id'=>$category->id_kategori,'status'=>'all'])}}">Semua</a></li>
                        @foreach($status as $s)
                            <li><a class="dropdown-item" href="{{route('detailCategory',['id'=>$category->id_kategori,'status'=>$s->nama_status])}}">{{$s->nama_status}}</a></li>
                        @endforeach
                    </ul>
                </div>

                    <table class="table table-striped table-hover mt-2">
                        <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
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

@include('partials.footer')

