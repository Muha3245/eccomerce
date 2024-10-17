@extends('layouts.app')

@section('admin')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Items (Products)</h6>
                <a class="btn btn-success mb-3" href="{{ route('items.create') }}">Create New Item</a>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Main Image</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Sizes</th>
                                <th>Subcategory</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($items as $item)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    @if ($item->main_image)
                                    <img src="{{ asset('/storage/items/' . $item->main_image) }}" width="50" alt="Main Image">
                                    @else
                                    <p>No Image</p>
                                    @endif
                                </td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ implode(', ', json_decode($item->sizes)) }}</td>
                                <td>{{ $item->subcategory->name ?? 'N/A' }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('items.edit', $item->id) }}">Edit</a>
                                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $items->links() }} <!-- Pagination links -->
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "timeOut": "5000", // Duration before the toast disappears
            "backgroundColor": "#808080", // Gray color
            "iconClass": "toast-success", // Class for the icon
        };

        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @elseif (session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    });
</script>

<style>
    .toast-success {
        background-color: #2de91c !important; /* Gray */
    }
</style>
@endsection
