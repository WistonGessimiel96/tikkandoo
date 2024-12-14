<?php

namespace App\Http\Controllers;

//use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function listUser(){
        $users = User::all();
        return view('pages.utilisateurs.clients', compact('users'));
    }
    public function addUser(){

    }
}
