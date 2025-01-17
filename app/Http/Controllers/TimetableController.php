<?php

namespace App\Http\Controllers;

use App\Models\AssignSubjectToClass;
use App\Models\Classes;
use App\Models\Day;
use App\Models\Subject;
use App\Models\Timetable;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['days'] = Day::all();
        $data['classes'] = Classes::all();
        $data['subjects'] = Subject::all();
        return view('admin.timetable.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $class_id = $request->class_id;
        $subject_id = $request->subject_id;
        foreach ($request->timetable as $timetable) {
            $day_id = $timetable['day_id'];
            $start_time = $timetable['start_time'];
            $end_time = $timetable['end_time'];
            $room_no = $timetable['room_no'];

            if ($start_time != null) {
                Timetable::updateOrCreate(
                    [
                        'class_id' => $class_id,
                        'subject_id' => $subject_id,
                        'day_id' => $day_id,
                    ],
                    [
                        'class_id' => $class_id,
                        'subject_id' => $subject_id,
                        'day_id' => $day_id,
                        'start_time' => $start_time,
                        'end_time' => $end_time,
                        'room_no' => $room_no,
                    ]
                );
            }
        }

        return redirect()->route('timetable.read')->with('success', 'Time Table added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function read(Request $request)
    {
        $data['classes'] = Classes::all();
        $data['subjects'] = [];

        $tabletimes = Timetable::with(['class', 'subject', 'day']);

        if ($request->class_id) {
            $tabletimes->where('class_id', $request->class_id);
            $data['subjects'] = AssignSubjectToClass::with('subject')->where('class_id', $request->class_id)->get();
        }

        if ($request->subject_id) {
            $tabletimes->where('subject_id', $request->subject_id);
        }

        $data['tabletimes'] = $tabletimes->get();

        return view('admin.timetable.list', $data);
    }

    public function readTeacher(Request $request)
    {
        $data['classes'] = Classes::all();
        $data['subjects'] = [];

        $tabletimes = Timetable::with(['class', 'subject', 'day']);

        if ($request->class_id) {
            $tabletimes->where('class_id', $request->class_id);
            $data['subjects'] = AssignSubjectToClass::with('subject')->where('class_id', $request->class_id)->get();
        }

        if ($request->subject_id) {
            $tabletimes->where('subject_id', $request->subject_id);
        }

        $data['tabletimes'] = $tabletimes->get();

        return view('teacher.time_table', $data);
    }

    public function readStudent(Request $request)
    {
        $data['classes'] = Classes::all();
        $data['subjects'] = [];

        $tabletimes = Timetable::with(['class', 'subject', 'day']);

        if ($request->class_id) {
            $tabletimes->where('class_id', $request->class_id);
            $data['subjects'] = AssignSubjectToClass::with('subject')->where('class_id', $request->class_id)->get();
        }

        if ($request->subject_id) {
            $tabletimes->where('subject_id', $request->subject_id);
        }

        $data['tabletimes'] = $tabletimes->get();

        return view('student.time_table', $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $data = Timetable::find($id);
        $data->delete();

        return redirect()->route('timetable.read')->with('success', 'Timetable deleted Successfully');
    }
}
