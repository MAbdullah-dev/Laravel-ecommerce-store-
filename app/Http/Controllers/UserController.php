<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users()
    {
       $users= User::where('role_id',3)->get();
        dd($users);
    }
}
