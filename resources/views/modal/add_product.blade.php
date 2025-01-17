<!-- Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/products" method="post">
                    @csrf
                    <label for="nama_produk" class="form-label">Nama produk</label>
                    <input class="form-control" type="text" name="nama_produk" id="nama_produk" value="{{old('nama_produk')}}">
                    <label for="harga" class="form-label">Harga</label>
                    <input class="form-control" type="text" name="harga" id="harga" value="{{old('harga')}}">

                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-control" name="kategori_id" id="kategori_id">
                        @foreach ($categories as $category)
                            <option value="{{$category->id_kategori}}">{{$category->nama_kategori}}</option>
                        @endforeach
                    </select>

                    <label class="form-label" for="status_id">Status</label>
                    <select class="form-control" name="status_id" id="status_id">
                        @foreach ($status as $s)
                            <option value="{{$s->id_status}}">{{$s->nama_status}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="form-control btn btn-primary mt-2">Tambah</button>
                </form>
            </div>

        </div>
    </div>
</div>
