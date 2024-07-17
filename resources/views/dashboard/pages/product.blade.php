<x-dashboard_component>
    <x-slot name="title">
        Products Page
      </x-slot>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <!-- <h3 class="page-title"> Buttons </h3> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="#">UI Elements</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Buttons</li> -->
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Insert your New Product</h4>
                            <div class="container mt-5">
                                <div class="alert alert-warning alert-dismissible fade show d-none" id="errorAlert"
                                    role="alert">
                                    <strong>ERRORS!</strong>
                                    <ul id="errorList"></ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                <form id="uploadProductForm" enctype="multipart/form-data"
                                    action="{{ route('product.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Product Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('name') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" id="image" name="image" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" step="0.01" name="price" id="price"
                                            class="form-control" value="{{ old('price') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="number" name="stock" id="stock" class="form-control"
                                            value="{{ old('stock') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="categories" class="form-label">Categories</label>
                                        <select class="form-control" id="categories" name="categories[]" multiple>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Upload Product</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Product Table</h4>
                            <div class="container mt-5">
                                <div class="container mt-5">
                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif
                                    <table class="table" id="productTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">ProductName</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Stock</th>
                                                <th scope="col">Delete</th>
                                                <th scope="col">Update</th>
                                            </tr>
                                        </thead>
                                        <!-- <tbody id="productList"></tbody> -->
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
</x-dashboard_component>
<script>
    $(document).ready(function() {
        // DataTable initialization
        var table = $('#productTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('product.index') }}", // Correct route for fetching product index
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                {
                    data: 'image',
                    name: 'image',
                    render: function(data, type, full, meta) {
                        return '<img src="{{ asset('uploads') }}/' + data + '" class="img-thumbnail" width="50">';
                    }
                },
                { data: 'price', name: 'price' },
                { data: 'stock', name: 'stock' },
                { data: 'store_id', name: 'store_id' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // AJAX form submission
        $('#uploadProductForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('product.store') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert('Product uploaded successfully');
                    // Reload the DataTable
                    table.ajax.reload();
                },
                error: function(response) {
                    let errors = response.responseJSON.errors;
                    showValidationErrors(errors);
                }
            });
        });

        // Delete product
        $('#productTable').on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this product?')) {
                $.ajax({
                    url: '/product/' + id,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert('Product deleted successfully');
                        // Reload the DataTable
                        table.ajax.reload();
                    },
                    error: function(response) {
                        alert('Error deleting product');
                    }
                });
            }
        });

        // Function to display validation errors
        function showValidationErrors(errors) {
            $('#errorList').empty();
            $.each(errors, function(key, error) {
                $('#errorList').append('<li>' + error[0] + '</li>');
            });
            $('#errorAlert').removeClass('d-none');
        }
    });
</script>

