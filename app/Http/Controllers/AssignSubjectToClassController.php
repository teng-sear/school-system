<?php

namespace App\Http\Controllers;

use App\Models\AssignSubjectToClass;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;

class AssignSubjectToClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['classes'] = Classes::all();
        $data['subjects'] = Subject::all();
        return view('admin.assign_subject.form', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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
    }

    /**
     * Display the specified resource.
     */
    public function show(AssignSubjectToClass $assignSubjectToClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssignSubjectToClass $assignSubjectToClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssignSubjectToClass $assignSubjectToClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssignSubjectToClass $assignSubjectToClass)
    {
        //
    }
}
