<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function show(User $user){
        // dd(compact('user'));
        return view('users.show', compact('user'));
    }
}
