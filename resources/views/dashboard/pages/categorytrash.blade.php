<x-dashboard_component>
    <x-slot name="title">
        categories Trash page
      </x-slot>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"> categories Trash</h4>
                            <div class="container mt-5">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($softcategories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>
                                                    <a type="button" class="btn btn-outline-danger"
                                                        href="{{ route('permanent.delete.category', $category->id) }}">
                                                        Permanent Delete ❌
                                                    </a>
                                                </td>
                                                <td>
                                                    <a type="button" class="btn btn-outline-warning"
                                                        href="{{ route('restore.category', $category->id) }}">
                                                        Restore ♻
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard_component>
