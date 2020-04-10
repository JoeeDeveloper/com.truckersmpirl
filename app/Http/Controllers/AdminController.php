<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function usersIndex(){

        $users = User::all();

        return view('userstable', compact('users'));
    }
}
