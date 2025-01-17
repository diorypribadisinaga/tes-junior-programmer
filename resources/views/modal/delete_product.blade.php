<!-- Modal -->
<div class="modal fade" id="deleteProductModal{{$product->id_produk}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Apakah anda yakin?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/products/{{$product->id_produk}}/delete" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="form-control btn btn-danger mt-2">Hapus</button>
                </form>
            </div>

        </div>
    </div>
</div>
