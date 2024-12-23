<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Classes;
use App\Models\FeeHead;
use App\Models\FeeStructure;
use Illuminate\Http\Request;

class FeeStructureController extends Controller
{
    public function index()
    {
        $data['classes'] = Classes::all();
        $data['academic_years'] = AcademicYear::all();
        $data['fee_heads'] = FeeHead::all();
        return view('admin.fee-structure.fee-structure', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'academic_year_id' => 'required',
            'class_id' => 'required',
            'fee_head_id' => 'required'
        ]);

        // koneksi dengan model database untuk menyimpan semua data
        FeeStructure::create($request->all());

        // redirec ke halaman dengan pesan sukses
        return redirect()->route('fee-structure.read')->with(
            'success',
            'Fee Structure Added Successfully'
        );
    }

    public function read()
    {
        $data['fee_structure'] = FeeStructure::with(['FeeHead', 'AcademicYear', 'Classes'])->latest()->get();
        // dd($data);

        // $data['fee-structure'] = FeeStructure::get(); // ['fee] itu untuk nama mapping nya
        // $fee['fee'] = FeeHead::latest()->get();

        return view('admin.fee-structure.fee_structure_list', $data);
    }

    public function edit($id)
    {
        $data['fee_structure'] = FeeStructure::find($id);
        $data['classes'] = Classes::all();
        $data['academic_years'] = AcademicYear::all();
        $data['fee_heads'] = FeeHead::all();
        return view('admin.fee-structure.fee_structure_edit', $data);
    }

    public function update(Request $request, $id)
    {
        $data = FeeStructure::find($id);
        $data->class_id = $request->class_id;
        $data->academic_year_id = $request->academic_year_id;
        $data->fee_head_id = $request->fee_head_id;
        $data->january = $request->january;
        $data->february = $request->february;
        $data->march = $request->march;
        $data->april = $request->april;
        $data->may = $request->may;
        $data->june = $request->june;
        $data->july = $request->july;
        $data->august = $request->august;
        $data->september = $request->september;
        $data->october = $request->october;
        $data->november = $request->november;
        $data->december = $request->december;

        $data->update();

        return redirect()->route('fee-structure.read')->with('success', 'Fee structure Updated Successfully');
    }

    public function delete($id)
    {
        $data = FeeStructure::find($id);

        if (!$data) {
            return redirect()->route('fee-structure.read')->with('error', 'Fee structure not found');
        }

        $data->delete();
        return redirect()->route('fee-structure.read')->with('success', 'Fee Structure Deleted Successfully');
    }
}
