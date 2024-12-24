<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.subject.form');
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
            'name' => 'required',
            'type' => 'required'
        ]);

        $subject = new Subject();
        $subject->name = $request->name;
        $subject->type = $request->type;
        $subject->save();

        // redirec ke halaman dengan pesan sukses
        return redirect()->route('subject.read')->with(
            'success',
            'Subject Added Successfully'
        );
    }

    public function read()
    {
        $data['subjects'] = Subject::latest()->get();
        return view('admin.subject.table', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['subject'] = Subject::find($id); // Harus menggunakan subject (tunggal)
        return view('admin.subject.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Subject::find($id);
        $data->name = $request->name;
        $data->type = $request->type;
        $data->update();

        return redirect()->route('subject.read')->with('success', 'Subject Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $data = Subject::find($id);
        $data->delete();
        return redirect()->route('subject.read')->with('success', 'Subject Deleted Successfully');
    }
}
