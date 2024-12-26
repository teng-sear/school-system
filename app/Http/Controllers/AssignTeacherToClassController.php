<?php

namespace App\Http\Controllers;

use App\Models\AssignSubjectToClass;
use App\Models\AssignTeacherToClass;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AssignTeacherToClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['classes'] = Classes::all();
        $data['teachers'] = User::where('role', 'teacher')->latest()->get();
        // dd($data);
        return view('admin.assign_teacher.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi input
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:users,id'
        ]);

        // update atau buat data baru
        AssignTeacherToClass::updateOrCreate(
            [
                'class_id' => $request->class_id,
                'subject_id' => $request->subject_id, // Perbaikan di sini
            ],
            [
                'teacher_id' => $request->teacher_id,
            ],
        );

        // redirec ke halaman dengan pesan sukses
        return redirect()->route('assign-teacher.read')->with(
            'success',
            'Assign teacher Added Successfully'
        );
    }

    public function read(Request $request)
    {
        $data['classes'] = Classes::all();
        $assign_teachers = AssignTeacherToClass::with(['class', 'subject', 'teacher']);

        if ($request->class_id) {
            $assign_teachers->where('class_id', $request->class_id);
        }

        $assign_teachers = $assign_teachers->latest()->get();
        $data['assign_teachers'] = $assign_teachers;

        return view('admin.assign_teacher.list', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $res = AssignTeacherToClass::find($id);
        $data['assign_teacher'] = $res;
        $data['subjects'] = AssignSubjectToClass::with('subject')->where('class_id', $res->class_id)->get();
        // dd($data['subjects']);
        $data['classes'] = Classes::all();

        $data['teachers'] = User::where('role', 'teacher')->latest()->get();

        return view('admin.assign_teacher.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = AssignTeacherToClass::find($id);
        $data->class_id = $request->class_id;
        $data->subject_id = $request->subject_id;
        $data->teacher_id = $request->teacher_id;
        $data->update();

        return redirect()->route('assign-teacher.read')->with('success', 'Assign teacher Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $data = AssignTeacherToClass::find($id);
        $data->delete();
        return redirect()->route('assign-teacher.read')->with('success', 'Assign teacher Deleted Successfully');
    }

    // opsi 1
    // public function findSubject(Request $request)
    // {
    //     $class_id = $request->class_id;
    //     $subjects = AssignSubjectToClass::with('subjects')->where('class_id', $class_id)->get();
    //     return response()->json([
    //         'status' => true,
    //         'subjects' => $subjects
    //     ]);
    // }

    // opsi 2
    public function findSubject(Request $request)
    {
        $class_id = $request->class_id;

        // Validasi class_id
        $request->validate([
            'class_id' => 'required|exists:classes,id',
        ]);

        // Ambil data subject berdasarkan class_id
        $subjects = AssignSubjectToClass::where('class_id', $class_id)
            ->with('subject') // Pastikan relasi 'subject' yang dipanggil
            ->get();

        // Format data untuk dikembalikan
        $formattedSubjects = $subjects->map(function ($assign) {
            return [
                'id' => $assign->subject->id,
                'name' => $assign->subject->name,
            ]; // Data diubah menjadi array sederhana dengan id dan name dari tabel subjects untuk memudahkan pengisian dropdown di JavaScript
        });

        return response()->json([
            'status' => true,
            'subjects' => $formattedSubjects,
        ]);
    }
}
