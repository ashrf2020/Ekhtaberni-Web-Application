<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Traits\MeetingZoomTrait;
use App\Models\Grade;
use App\Models\online_classe;
use App\Models\Teacher;
use Illuminate\Http\Request;
use MacsiDigital\Zoom\Facades\Zoom;

class OnlineClasseController extends Controller
{
    use MeetingZoomTrait;
    public function index()
    {
        // If a teacher is authenticated, show only online classes for the teacher's sections
        if (auth('teacher')->check()) {
            $sectionIds = Teacher::findOrFail(auth('teacher')->id())
                ->Sections()
                ->pluck('section_id');

            $online_classes = online_classe::whereIn('section_id', $sectionIds)->get();
        } else {
            // Admin or other guards: show all
            $online_classes = online_classe::all();
        }

        return view('pages.online_classes.index', compact('online_classes'));
    }


    public function create()
    {
        $Grades = Grade::all();
        return view('pages.online_classes.add', compact('Grades'));
    }


    public function store(Request $request)
    {
        try {

            $meeting = $this->createMeeting($request);
            online_classe::create([
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'user_id' => auth()->user()->id,
                'meeting_id' => $meeting->id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $meeting->duration,
                'password' => $meeting->password,
                'start_url' => $meeting->start_url,
                'join_url' => $meeting->join_url,
            ]);
            toastr()->success(trans('messages.success_add'));
            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }
    public function destroy(Request $request)
    {
        try {
            $meeting = Zoom::meeting()->find($request->id);
            $meeting->delete();
            online_classe::where('meeting_id', $request->id)->delete();
            toastr()->success(trans('messages.success_delete'));
            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }
}