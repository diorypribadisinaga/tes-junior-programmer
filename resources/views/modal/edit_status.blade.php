<!-- Modal -->
<div class="modal fade" id="editStatusModal{{$s->id_status}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit status</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/status/{{$s->id_status}}/edit" method="post">
                    @method('PUT')
                    @csrf
                    <label for="nama_status{{$s->id_status}}" class="form-label">Nama status</label>
                    <input class="form-control nama_status" type="text" name="nama_status"
                           id="nama_status{{$s->id_status}}"
                           value="{{$s->nama_status}}">
                    <button id="simpan_{{$s->id_status}}" type="submit"
                            class="form-control btn btn-warning mt-2 simpan">Simpan</button>
                </form>
            </div>

        </div>
    </div>
</div>

