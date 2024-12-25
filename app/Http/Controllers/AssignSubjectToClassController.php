<?php

namespace App\Http\Controllers;

use App\Models\AssignSubjectToClass;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;

class AssignSubjectToClassController extends Controller
{
    public function index()
    {
        $data['classes'] = Classes::all();
        $data['subjects'] = Subject::all();
        return view('admin.assign_subject.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'subject_id' => 'required'
        ]);

        $class_id = $request->class_id;
        $subject_id = $request->subject_id;

        foreach ($subject_id as $subject) {
            AssignSubjectToClass::updateOrCreate(
                [
                    'class_id' => $class_id,
                    'subject_id' => $subject
                ],
                [
                    'class_id' => $class_id,
                    'subject_id' => $subject
                ],
            );
        }

        // redirec ke halaman dengan pesan sukses
        return redirect()->route('assign-subject.read')->with(
            'success',
            'Assign subject Added Successfully'
        );
    }

    public function read(Request $request)
    {
        $query = AssignSubjectToClass::with(['class', 'subject']);

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->get('class_id'));
        }

        $data['assign_subjects'] = $query->get();  // Harus menggunakan subjects (banyak)
        $data['classes'] = Classes::all();

        return view('admin.assign_subject.table', $data);
    }

    public function edit($id)
    {
        $data['assign_subject'] = AssignSubjectToClass::find($id); // Harus menggunakan subject (tunggal)
        $data['classes'] = Classes::all();
        $data['subjects'] = Subject::all();

        return view('admin.assign_subject.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $data = AssignSubjectToClass::find($id);
        $data->class_id = $request->class_id;
        $data->subject_id = $request->subject_id;
        $data->update();

        return redirect()->route('assign-subject.read')->with('success', 'Assign subject Updated Successfully');
    }

    public function delete($id)
    {
        $data = AssignSubjectToClass::find($id);
        $data->delete();
        return redirect()->route('assign-subject.read')->with('success', 'Assign subject Deleted Successfully');
    }
}
