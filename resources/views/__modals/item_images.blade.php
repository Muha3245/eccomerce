<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Images for Item ID <span id="item-id"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modalForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="item_id" id="item-id-input">
                    <div class="mb-3">
                        <label for="images" class="form-label">Upload Images</label>
                        <input type="file" name="images[]" id="images" class="form-control" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Images</button>
                </form>
            </div>
        </div>
    </div>
</div>
