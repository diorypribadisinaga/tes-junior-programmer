<!-- Modal -->
<div class="modal fade" id="addStatusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Status</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/status" method="post">
                    @csrf
                    <label for="nama_status" class="form-label">Nama status</label>
                    <input class="form-control" type="text" name="nama_status" id="nama_status" value="{{old('nama_status')}}">
                    <button type="submit" class="form-control btn btn-primary mt-2">Tambah</button>
                </form>
            </div>

        </div>
    </div>
</div>
