<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        return view('admin.teacher.teacher_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'dob' => 'required',
            'mobno' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->dob = $request->dob;
        $user->mobno = $request->mobno;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'teacher';
        $user->save();

        // redirec ke halaman dengan pesan sukses
        return redirect()->route('teacher.read')->with(
            'success',
            'Teacher Added Successfully'
        );
    }

    public function read()
    {
        $data['teachers'] = User::where('role', 'teacher')->latest()->get();

        return view('admin.teacher.teacher_list', $data);
    }

    public function edit($id)
    {
        $data['teacher'] = User::find($id);
        return view('admin.teacher.teacher_edit', $data);
    }

    public function update(Request $request, $id)
    {
        $teacher = User::find($id);
        $teacher->name = $request->name;
        $teacher->father_name = $request->father_name;
        $teacher->mother_name = $request->mother_name;
        $teacher->dob = $request->dob;
        $teacher->mobno = $request->mobno;
        $teacher->email = $request->email;
        $teacher->update();

        return redirect()->route('teacher.read')->with('success', 'Teacher Updated Successfully');
    }

    public function delete($id)
    {
        $teacher = User::find($id);
        $teacher->delete();
        return redirect()->route('teacher.read')->with('success', 'Teacher Deleted Successfully');
    }

    public function login()
    {
        return view('teacher.login');
    }

    public function authenticate(Request $req)
    {
        // make nu admin authenticate
        $req->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::guard('teacher')->attempt(['email' => $req->email, 'password' => $req->password])) {
            if (Auth::guard('teacher')->user()->role != 'teacher') {
                Auth::guard('teacher')->logout();
                return redirect()->route('teacher.login')->with('error', 'Unautherize user. Access denied!');
            }

            return redirect()->route('teacher.dashboard');
        } else {
            return redirect()->route('teacher.login')->with('error', 'Something went wrong');
        }

        // make nu student authenticate
        // if (Auth::attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ])) {
        //     if (Auth::user()->role != 'teacher') {
        //         Auth::logout();
        //         return redirect()->route('teacher.login')->with('error', 'Unautherize user. Access denied!');
        //     }

        //     return redirect()->route('teacher.dashboard');
        // } else {
        //     return redirect()->route('teacher.login')->with('error', 'Something went wrong');
        // }
    }

    // dashboard 
    public function dashboard()
    {
        return view('teacher.dashboard');
    }

    // logout 
    public function logout()
    {
        Auth::guard('teacher')->logout();
        return redirect()->route('teacher.login')->with('success', 'Logout succesfully');
    }
}
