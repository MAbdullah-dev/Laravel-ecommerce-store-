<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class DashboardConroller extends Controller
{
    public function dashboardpage()
    {
        return view('dashboard.homedashboard');
    }
    public function productcrudpage()
    {
        $categories = Category::get();
        return view('dashboard.pages.product', compact('categories'));
    }
    public function category_crud_page()
    {
        return view('dashboard.pages.categories');
    }
}
