<!-- Modal -->
<div class="modal fade" id="editCategoryModal{{$category->id_kategori}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kategori</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/categories/{{$category->id_kategori}}/edit" method="post">
                    @method('PUT')
                    @csrf
                    <label for="nama_kategori{{$category->id_kategori}}" class="form-label">Nama kategori</label>
                    <input class="form-control nama_kategori" type="text" name="nama_kategori"
                           id="nama_kategori{{$category->id_kategori}}"
                           value="{{$category->nama_kategori}}">
                    <button id="simpan_{{$category->id_kategori}}" type="submit"
                            class="form-control btn btn-warning mt-2 simpan">Simpan</button>
                </form>
            </div>

        </div>
    </div>
</div>

