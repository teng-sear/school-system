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
        return redirect()->route('fee-head.read')->with(
            'success',
            'Fee Added Successfully'
        );
    }

    public function read()
    {
        $fee['fee'] = FeeHead::get();
        // $fee['fee'] = FeeHead::latest()->get();

        return view('admin.fee-head.fee_list', $fee);
    }

    public function edit($id)
    {
        $fee['fee'] = FeeHead::find($id);
        return view('admin.fee-head.fee_edit', $fee);
    }

    public function update(Request $request)
    {
        $fee = FeeHead::find($request->id);
        $fee->name = $request->name;
        $fee->update();

        return redirect()->route('fee-head.read')->with('success', 'Fee Updated Successfully');
    }
}
