<!-- Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/categories" method="post">
                    @csrf
                    <label for="nama_kategori" class="form-label">Nama kategori</label>
                    <input class="form-control" type="text" name="nama_kategori" id="nama_kategori" value="{{old('nama_kategori')}}">
                    <button type="submit" class="form-control btn btn-primary mt-2">Tambah</button>
                </form>
            </div>

        </div>
    </div>
</div>
