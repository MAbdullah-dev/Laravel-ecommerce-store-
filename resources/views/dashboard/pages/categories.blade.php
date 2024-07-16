<x-dashboard_component>
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
                            <h4 class="card-title">Category Management</h4>
                            <div class="container mt-5">
                                <div class="alert alert-warning alert-dismissible fade show d-none" id="CerrorAlert" role="alert">
                                    <strong>ERRORS!</strong>
                                    <ul id="CerrorList"></ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <form id="categoryForm">
                                    <div class="mb-3">
                                        <label for="categoryName" class="form-label">Category Name</label>
                                        <input type="text" name="name" id="categoryName" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Category</button>
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
                            <h4 class="card-title">Categories List</h4>
                            <div class="container mt-5">
                                <table class="table table-bordered" id="categoryList">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Categories will be loaded here via AJAX -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>


 <!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning alert-dismissible fade show d-none" id="modalErrorAlert" role="alert">
                    <strong>ERRORS!</strong>
                    <ul id="modalErrorList"></ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <form id="editCategoryForm">
                    <div class="mb-3">
                        <label for="editCategoryName" class="form-label">Category Name</label>
                        <input type="text" name="name" id="editCategoryName" class="form-control">
                    </div>
                    <input type="hidden" id="editCategoryId">
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </form>
            </div>
        </div>
    </div>
</div>
</x-dashboard_component>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#categoryList').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('categories.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                {
                    data: 'id',
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <button class="btn btn-sm btn-primary editBtn" data-id="${data}">Edit</button>
                            <button class="btn btn-sm btn-danger deleteBtn" data-id="${data}">Delete</button>
                        `;
                    }
                }
            ]
        });

        // Add category via AJAX
        $('#categoryForm').on('submit', function(e) {
            e.preventDefault();
            let name = $('#categoryName').val();

            $.ajax({
                url: "{{ route('categories.store') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    name: name
                },
                success: function(response) {
                    $('#categoryName').val('');
                    table.ajax.reload(); // Reload DataTable
                },
                error: function(response) {
                    showValidationErrors(response.responseJSON.errors, '#CerrorList', '#CerrorAlert');
                }
            });
        });

        // Show edit modal
        $('#categoryList').on('click', '.editBtn', function() {
            var id = $(this).data('id');

            $.ajax({
                url: '/categories/' + id + '/edit',
                type: 'GET',
                success: function(response) {
                    $('#editCategoryId').val(response.category.id);
                    $('#editCategoryName').val(response.category.name);
                    $('#editCategoryModal').modal('show');
                }
            });
        });

        // Update category via AJAX
        $('#editCategoryForm').on('submit', function(e) {
            e.preventDefault();
            let id = $('#editCategoryId').val();
            let name = $('#editCategoryName').val();

            $.ajax({
                url: '/categories/' + id,
                type: 'PUT',
                data: {
                    _token: "{{ csrf_token() }}",
                    name: name
                },
                success: function(response) {
                    $('#editCategoryModal').modal('hide');
                    table.ajax.reload(); // Reload DataTable
                },
                error: function(response) {
                    showValidationErrors(response.responseJSON.errors, '#modalErrorList', '#modalErrorAlert');
                }
            });
        });

        // Delete category via AJAX
        $('#categoryList').on('click', '.deleteBtn', function() {
            var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this category?')) {
                $.ajax({
                    url: '/categories/' + id,
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        table.ajax.reload(); // Reload DataTable
                    }
                });
            }
        });

        // Function to display validation errors
        function showValidationErrors(errors, errorListSelector, errorAlertSelector) {
            $(errorListSelector).empty();

            $.each(errors, function(key, error) {
                $(errorListSelector).append('<li>' + error[0] + '</li>');
            });

            $(errorAlertSelector).removeClass('d-none');
        }
    });
</script>
