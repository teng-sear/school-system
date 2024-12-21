<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // default route
    public function index()
    {
        return view('admin.login');
    }

    // authentikasi login 
    public function authenticate(Request $req)
    {
        $req->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::guard('admin')->attempt(['email' => $req->email, 'password' => $req->password])) {
            if (Auth::guard('admin')->user()->role != 'admin') {
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->with('error', 'Unautherize user. Access denied!');
            }

            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login')->with('error', 'Something went wrong');
        }
    }

    // register admin
    public function register()
    {
        $user = new User();
        $user->name = 'Nabil fadilah';
        $user->role = 'student';
        $user->email = 'nabil@gmail.com';
        $user->password = Hash::make('student');
        $user->save();
        return redirect()->route('admin.login')->with('success', 'User created succesfully');
    }

    // logout 
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logout succesfully');
    }

    // dashboard 
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // form 
    public function form()
    {
        return view('admin.form');
    }

    // table list data
    public function table()
    {
        return view('admin.table');
    }
}
