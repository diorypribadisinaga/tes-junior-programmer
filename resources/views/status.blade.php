@include('partials.header')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('partials.sidebar',['active'=>'status'])

        <!-- Main Content -->
        <div class="col-md-10">
            <div class="container py-4">
                <h6 style="text-align: right">{{now('Asia/Jakarta')->isoFormat('dddd, D MMMM YYYY')}}</h6>

                <h2>Status</h2>

                <!-- Status Section -->
                <div id="status" class="mt-4">
                    <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal"
                            data-bs-target="#addStatusModal">
                        Tambah status</button>
                    @include('modal.add_status')

                    {{-- Table Status --}}
                    <table class="table table-striped table-hover sortable">
                        <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Status</th>
                            <th>Banyak Produk</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($status as $s)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$s->nama_status}}</td>
                                <td>{{$s->produk()->count()}}</td>

                                <td>
                                    <button class="btn btn-sm btn-warning"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editStatusModal{{$s->id_status}}">
                                        Edit</button>
                                    @include('modal.edit_status')

                                    <button class="btn btn-sm btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteCategoryModal{{$s->id_status}}">
                                        Hapus</button>
                                    @include('modal.delete_status')
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

