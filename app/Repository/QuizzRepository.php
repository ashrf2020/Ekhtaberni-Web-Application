<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Quizze;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Question;

class QuizzRepository implements QuizzRepositoryInterface
{

    public function index()
    {
        if (auth()->user() instanceof Teacher) {
            $quizzes = Quizze::where('teacher_id', auth()->id())->get();
        } else {
            // Admins (or any non-Teacher user) can see all quizzes
            $quizzes = Quizze::all();
        }
        return view('pages.Quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        return view('pages.Quizzes.create', $data);
    }
    public function show($id)
    {
        $questions = Question::where('quizze_id',$id)->get();
        $quizz = Quizze::findorFail($id);
        return view('pages.Questions.index',compact('questions','quizz'));
    }
    public function store($request)
    {
        try {

            $quizzes = new Quizze();
            $quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id;
            $quizzes->classroom_id = $request->Classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = auth()->user()->id;
            $quizzes->save();
            toastr()->success(trans('messages.success_add'));
            return redirect()->route('Quizzes.create');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        if (auth()->user() instanceof Teacher) {
            $quizz = Quizze::where('id', $id)->where('teacher_id', auth()->id())->firstOrFail();
        } else {
            // Admins (or any non-Teacher user) can edit any quiz
            $quizz = Quizze::findOrFail($id);
        }
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        return view('pages.Quizzes.edit', $data, compact('quizz'));
    }

    public function update($request)
    {
        try {
            if (auth()->user() instanceof Teacher) {
                $quizz = Quizze::where('id', $request->id)->where('teacher_id', auth()->id())->firstOrFail();
            } else {
                // Admins (or any non-Teacher user) can update any quiz
                $quizz = Quizze::findOrFail($request->id);
            }
            $quizz->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizz->subject_id = $request->subject_id;
            $quizz->grade_id = $request->Grade_id;
            $quizz->classroom_id = $request->Classroom_id;
            $quizz->section_id = $request->section_id;
            $quizz->teacher_id = auth()->user()->id;
            $quizz->save();
            toastr()->success(trans('messages.success_update'));
            return redirect()->route('Quizzes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            if (auth()->user() instanceof Teacher) {
                Quizze::where('id', $request->id)->where('teacher_id', auth()->id())->firstOrFail()->delete();
            } else {
                // Admins (or any non-Teacher user) can delete any quiz
                Quizze::findOrFail($request->id)->delete();
            }
            toastr()->error(trans('messages.success_delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}