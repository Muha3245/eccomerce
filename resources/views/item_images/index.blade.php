@extends('layouts.app')

@section('admin')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Item Images</h6>
                <a class="btn btn-success mb-3" href="{{ route('item_images.create') }}">Add Item Images</a>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Item</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0; @endphp
                            @foreach ($itemImages as $itemImage)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $itemImage->item->title ?? 'N/A' }}</td>
                                <td><img src="{{ asset('/storage/item_images/' . $itemImage->image) }}" width="50" alt="Image"></td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('item_images.edit', $itemImage->id) }}">Edit</a>
                                    <form action="{{ route('item_images.destroy', $itemImage->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $itemImages->links() }} <!-- Pagination links -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
