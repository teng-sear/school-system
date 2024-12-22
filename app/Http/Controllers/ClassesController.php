<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index()
    {
        return view('admin.class.class');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required' // kalau misalnya ada kolom baru maka ini juga tambah
        ]);
        $data = new Classes();
        $data->name = $request->name;
        $data->save();

        // redirec ke halaman dengan pesan sukses
        return redirect()->route('class.read')->with(
            'success',
            'Class Added Successfully'
        );
    }

    public function read()
    {
        $data['class'] = Classes::get();

        return view('admin.class.class_list', $data);
    }
}
