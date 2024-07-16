<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductConroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $store_id =Auth::user()->store->id; // Get the logged-in user's ID
        $products = Product::where('store_id', $store_id)
        ->select(['id', 'name', 'description', 'image', 'price', 'stock', 'store_id', 'deleted_at'])
        ->get();

        return DataTables::of($products)
            ->addColumn('action', function ($product) {
                $editUrl = route('product.edit', $product->id);
                $deleteUrl = route('product.destroy', $product->id);

                return "<a href='$editUrl' class='btn btn-sm btn-primary'>Edit</a>
                        <button class='btn btn-sm btn-danger delete-btn' data-id='$product->id'>Delete</button>";
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categories' => 'required|array',
            'categories.*' => 'integer|exists:categories,id',
        ]);

        // Check if 'uploads' directory exists, if not, create it
        $uploadsPath = public_path('uploads');
        if (!File::exists($uploadsPath)) {
            File::makeDirectory($uploadsPath, 0777, true, true);
        }

        // Store the image in 'public/uploads'
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move($uploadsPath, $imageName);

        // Create the product
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' =>  $imageName,
            'price' => $request->price,
            'stock' => $request->stock,
            'store_id' => Auth::user()->store->id
        ]);

        // Attach categories
        $product->categories()->attach($request->categories);

        return response()->json(['message' => 'Product uploaded successfully', 'product' => $product]);
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $product= Product::find($id);
       return view('frontend.product_detail',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = category::all();
        return view('dashboard.pages.productupdate', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'categories' => 'required|array',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $product->image = $imageName;
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        $product->categories()->sync($request->categories);

        return redirect()->route('product.crud.page')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['success' => 'Product deleted successfully']);
    }

    public function trash_products()
    {
        $softDeletedProducts = Product::onlyTrashed()->get();
        return view('dashboard.pages.productTrash', ['softProducts' => $softDeletedProducts]);
    }

    public function restore_product($id)
    {
        Product::withTrashed()->find($id)->restore();
        return redirect()->route('product.crud.page');

    }
    public function force_delete($id)
    {
        $product = Product::withTrashed()->find($id);

        // Delete associated image if it exists
        if ($product->image) {
            $imagePath = public_path('uploads/' . $product->image);

            // Check if the file exists before attempting deletion
            if (File::exists($imagePath)) {
                // Delete the file using the PHP function
                File::delete($imagePath);
            }
        }

        // Permanently delete the product
        $product->forceDelete();

        return redirect()->route('trash.products');
    }
}
