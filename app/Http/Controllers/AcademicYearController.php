<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    public function index()
    {
        return view('admin.academic_year');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required'
    //     ]);
    //     $data = new AcademicYear();
    //     $data->name = $request->name;
    //     $data->save();

    //     // redirec ke halaman dengan pesan sukses
    //     return redirect()->route('academic-year.read')->with(
    //         'success',
    //         'Academic Year Added Successfully'
    //     );
    // }

    // opsi ke-2
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'tahunAkademik' => 'required|string'
        ]);

        // Simpan data
        $data = new AcademicYear();
        $data->name = $request->tahunAkademik;
        $data->save();

        // Redirect dengan pesan sukses
        return redirect()->route('academic-year.read')->with(
            'success',
            'Academic Year Added Successfully'
        );
    }

    public function read(Request $request)
    {
        $data['academic_year'] = AcademicYear::get();

        return view('admin.academic_year_list', $data);
    }

    public function delete($id)
    {
        $data = AcademicYear::find($id);

        if (!$data) {
            return redirect()->route('academic-year.read')->with('error', 'Academic Year not found');
        }

        $data->delete();
        return redirect()->route('academic-year.read')->with('success', 'Academic Year Deleted Successfully');
    }

    public function edit($id)
    {
        $data['academic_year'] = AcademicYear::findOrFail($id); // Pastikan data ditemukan
        return view('admin.academic_year_edit', $data);
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'tahunAkademik' => 'required|string|regex:/^\d{4}\/\d{4}(?:\s\w+)?$/'
        ]);


        // Cari data berdasarkan ID
        $academicYear = AcademicYear::findOrFail($request->id);

        // Update data
        $academicYear->name = $request->tahunAkademik;
        $academicYear->save();

        // Redirect dengan pesan sukses
        return redirect()->route('academic-year.read')->with('success', 'Academic Year Updated Successfully');
    }
}
