<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('actions', function($category) {
                return '<button class="btn btn-sm btn-primary editBtn" data-id="' . $category->id . '">Edit</button>
                        <button class="btn btn-sm btn-danger deleteBtn" data-id="' . $category->id . '">Delete</button>';
            })
            ->rawColumns(['actions'])
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
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        category::create([
            'name' => $request->name,
        ]);

        return response()->json(['success' => 'Category added successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return response()->json(['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
        ]);

        return response()->json(['success' => 'Category updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['success' => 'Category deleted successfully.']);
    }
    public function trash_data()
    {
        $softDeletedcategorys = category::onlyTrashed()->get();
        return view('dashboard.pages.categoryTrash', ['softcategories' => $softDeletedcategorys]);
    }

    public function restore_category($id)
    {
        category::withTrashed()->find($id)->restore();
        return redirect()->route('product.crud.page');

    }
    public function force_delete($id)
    {
        category::withTrashed()->find($id)->forceDelete();

        return redirect()->route('trash.categories');
    }
}
