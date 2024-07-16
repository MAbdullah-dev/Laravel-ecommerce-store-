<x-dashboard_component>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Product</h4>
                    <div class="container mt-5">
                        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}">
                                @error('name')
                                    <li><span class="text-danger">{{ $message }}</span></li>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <li><span class="text-danger">{{ $message }}</span></li>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" id="image" name="image" class="form-control">
                                <img src="{{ asset("uploads/$product->image") }}" alt="{{ $product->name }}" class="img-thumbnail mt-2" width="150">
                                @error('image')
                                    <li><span class="text-danger">{{ $message }}</span></li>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}">
                                @error('price')
                                    <li><span class="text-danger">{{ $message }}</span></li>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $product->stock) }}">
                                @error('stock')
                                    <li><span class="text-danger">{{ $message }}</span></li>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="categories" class="form-label">Categories</label>
                                <select class="form-control" id="categories" name="categories[]" multiple>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', $product->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('categories')
                                    <li><span class="text-danger">{{ $message }}</span></li>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard_component>

