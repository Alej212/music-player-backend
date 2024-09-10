<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //* Create user
    public function createOneUser() {} 
    //* Delete user
    public function deleteOneUser() {}
    //* Obtain user
    public function obtainOneUser() {}
    //* Obtain all users
    public function obtainAllUsers() {
        $user = User::find(1);
        echo $user;
        return response()->json(['message', "all users showed successfully"], 201);
    }
}
