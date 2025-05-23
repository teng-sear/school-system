<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $data['classes'] = Classes::all();
        $data['academic_years'] = AcademicYear::all();
        return view('admin.student.student', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'academic_year_id' => 'required',
            'class_id' => 'required',
            'name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'admission_date' => 'required',
            'dob' => 'required',
            'mobno' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = new User();
        $user->academic_year_id = $request->academic_year_id;
        $user->class_id = $request->class_id;
        $user->name = $request->name;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->admission_date = $request->admission_date;
        $user->dob = $request->dob;
        $user->mobno = $request->mobno;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'student';
        $user->save();

        // // koneksi dengan model database untuk menyimpan semua data
        // FeeStructure::create($request->all());

        // redirec ke halaman dengan pesan sukses
        return redirect()->route('student.read')->with(
            'success',
            'Student Added Successfully'
        );
    }

    public function read(Request $request)
    {
        $query = User::with(['studentClass', 'studentAcademicYear'])
            ->where('role', 'student')
            ->latest('id');
        // ->get(); // Mengambil data sebagai collection

        if ($request->filled('academic_year_id')) {
            $query->where('academic_year_id', $request->get('academic_year_id'));
        }

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->get('class_id'));
        }

        $students = $query->get();
        $data['students'] = $students;
        $data['academic_year'] = AcademicYear::all();
        $data['classes'] = Classes::all();

        return view('admin.student.student_list', $data);
    }

    public function edit($id)
    {
        $data['classes'] = Classes::all();
        $data['academic_years'] = AcademicYear::all();
        $data['student'] = User::find($id);
        return view('admin.student.student_edit', $data);
    }

    public function update(Request $request, $id)
    {
        // Debug request method
        // dd($request->method());

        // Debug semua data yang diterima
        // dd($request->all());

        // Logic update
        $user = User::find($id);
        $user->academic_year_id = $request->academic_year_id;
        $user->class_id = $request->class_id;
        $user->name = $request->name;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->admission_date = $request->admission_date;
        $user->dob = $request->dob;
        $user->mobno = $request->mobno;
        $user->email = $request->email;
        $user->update();

        return redirect()->route('student.read')->with('success', 'Student Updated Successfully');
    }

    public function delete($id)
    {
        $student = User::find($id);
        $student->delete();
        return redirect()->route('student.read')->with('success', 'Student Deleted Successfully');
    }
}
