<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\category;
use Illuminate\Http\Request;

class DashboardConroller extends Controller
{
    public function dashboardpage()
    {
        $users= User::where('role_id',3)->withTrashed()->get();
        $store_owners=User::where('role_id',2)->with('store')->withTrashed()->get();

        return view('dashboard.homedashboard',compact('users','store_owners'));
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
