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
                            <h4 class="card-title">Insert your New Product</h4>
                            <div class="container mt-5">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">ProductName</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Stock</th>
                                            <th scope="col">Permanent Delete</th>
                                            <th scope="col">Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($softProducts as $product)
                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->description }}</td>
                                                <td><img src="{{ asset("uploads/$product->image") }}" alt="{{ $product->name }}"
                                                        width="50"></td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td><a type="button" class="btn btn-outline-danger"
                                                        href="{{ route('permanent.delete.product',$product->id) }}">Permanent Delete❌</a></td>
                                                <td><a type="button" class="btn btn-outline-warning"
                                                        href="{{ route('restore.product',$product->id) }}">Restore♻</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</x-dashboard_component>
