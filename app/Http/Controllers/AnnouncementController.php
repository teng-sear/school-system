<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.announcement.form');
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
            'message' => 'required',
            'type' => 'required'
        ]);
        $announcement = new Announcement();
        $announcement->message = $request->message;
        $announcement->type = $request->type;
        $announcement->save();

        // redirec ke halaman dengan pesan sukses
        return redirect()->route('announcement.read')->with(
            'success',
            'Announcement Added Successfully'
        );
    }

    public function read()
    {
        $data['announcements'] = Announcement::latest()->get();
        return view('admin.announcement.list', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['announcement'] = Announcement::find($id);
        return view('admin.announcement.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $announcement = Announcement::find($id);
        $announcement->message = $request->message;
        $announcement->type = $request->type;
        $announcement->update();

        // redirec ke halaman dengan pesan sukses
        return redirect()->route('announcement.read')->with(
            'success',
            'Announcement Updated Successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        //
    }
}
