<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AssignTeacherToClass;
use App\Models\Timetable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('student.login');
    }

    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role != 'student') {
                Auth::logout();
                return redirect()->route('student.login')->with('error', 'Unautherize user. Access denied!');
            }

            return redirect()->route('student.dashboard');
        } else {
            return redirect()->route('student.login')->with('error', 'Something went wrong');
        }
    }

    public function dashboard()
    {
        $data['announcement'] = Announcement::where('type', 'student')->latest()->limit(1)->get();

        return view('student.dashboard', $data);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('student.login')->with('error', 'Logout successfully');
    }

    public function changePassword()
    {
        return view('student.change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password'
        ]);
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        // $confirm_password = $request->confirm_password;
        $user = User::find(Auth::user()->id); // find user

        if (Hash::check($old_password, $user->password)) {
            $user->password = Hash::make($new_password);
            $user->save();
            return redirect()->back()->with('success', 'Password updated successfully');
        } else {
            return redirect()->back()->withErrors(['old_password' => 'Old password is incorrect']);
        }
    }

    public function mySubject()
    {
        $class_id = Auth::guard('web')->user()->class_id;
        $data['my_subjects'] = AssignTeacherToClass::where('class_id', $class_id)->with('subject', 'teacher')->get();

        return view('student.my_subject', $data);
    }

    // public function timetable()
    // {
    //     $class_id = Auth::guard('web')->user()->class_id;
    //     $timetable = Timetable::with(['day', 'subject'])->where('class_id', $class_id)->get();
    //     $group = [];
    //     foreach ($timetable as $data) {
    //         $group[$data->day->name][] = [
    //             'subject' => $data->subject->name,
    //             'start_time' => $data->start_time,
    //             'end_time' => $data->end_time,
    //             'room_no' => $data->room_no,
    //         ];
    //     };
    //     // dd($group);
    //     $data['timetable'] = $group;
    //     return view('student.timetable', $data);
    // }

    public function timetable()
    {
        $class_id = Auth::guard('web')->user()->class_id;
        $timetable = Timetable::with(['day', 'subject'])->where('class_id', $class_id)->get();

        // Periksa apakah semua entri memiliki relasi subject
        foreach ($timetable as $data) {
            if (!$data->subject) {
                dd('Missing subject for timetable ID: ' . $data->id);
            }
        }

        $group = [];
        foreach ($timetable as $data) {
            $group[$data->day->name][] = [
                'subject' => $data->subject->name,
                'start_time' => $data->start_time,
                'end_time' => $data->end_time,
                'room_no' => $data->room_no,
            ];
        }

        $data['timetable'] = $group;
        return view('student.timetable', $data);
    }
}
