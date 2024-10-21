@extends('layouts.app')

@section('admin')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Edit Item Image</h6>
                <button type="button" class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModal"
                        data-id="{{ $itemImage->item_id }}"
                        onclick="loadModalData(this)"
                        >
                    Launch Modal for Image ID {{ $itemImage->item_id }}
                </button>
                <form action="{{ route('item_images.update', $itemImage->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="item_id" class="form-label">Select Item</label>
                        <select class="form-select" name="item_id" required>
                            <option value="">Select Item</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $itemImage->item_id ? 'selected' : '' }}>{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="images" class="form-label">Upload New Images (Leave blank if not changing)</label>
                        <input type="file" name="images[]" multiple class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Images</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('__modals.item_images')

<script>
    function loadModalData(button) {
        // Get the item ID from the button's data attributes
        var itemId = button.getAttribute('data-id');
        alert(itemId)

        // Set the item ID in the modal
        document.getElementById('item-id').innerText = itemId;
        document.getElementById('item-id-input').value = itemId;
    }

    // Optional: Handle form submission
    document.getElementById('modalForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Use FormData to gather all form data, including files
        var formData = new FormData(this);
        console.log(formData)

        // Send AJAX request to store the images
        fetch('/item-images', { // Replace with your actual route
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // Handle success (e.g., close modal, refresh page, etc.)
                $('#exampleModal').modal('hide');
                // Optionally refresh the page or update the UI
            } else {
                // Handle error
                alert('Error: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>



@endsection
