<?php

namespace App\Http\Controllers;

use App\Models\FeeHead;
use Illuminate\Http\Request;

class FeeHeadController extends Controller
{
    public function index()
    {
        return view('admin.fee-head.fee-head');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required' // kalau misalnya ada kolom baru maka ini juga tambah
        ]);
        $fee = new FeeHead();
        $fee->name = $request->name;
        $fee->save();

        // redirec ke halaman dengan pesan sukses
        return redirect()->route('fee-head.create')->with(
            'success',
            'Fee Added Successfully'
        );
    }
}
