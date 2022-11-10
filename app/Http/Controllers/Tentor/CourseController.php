<?php

namespace App\Http\Controllers\Tentor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Level;
use App\Models\Review;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(){
        $courses = Course::whereUserId(auth()->user()->id)->whereNotIn('status', ['Deleted'])->paginate(5);
        $lessons = Lesson::all();
        $levels = Level::orderBy('number', 'asc')->get();
        return view('tentor.course.index', compact('courses', 'lessons', 'levels'));
    }    
    public function store(Request $request){
        $this->validate($request, [
            'user_id' => 'required|max:200000000|numeric',
            'lesson_id' => 'required|max:200000000|numeric',
            'level_id' => 'required|max:200000000|numeric',
            'status' => 'required|max:20',
            'price' => 'required|max:200000000|numeric',
            'force' => 'required|max:1|numeric',
        ]);
        $course = Course::create($request->except('force'));
        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }
    public function show($id){
        $course = Course::find($id);
        $lessons = Lesson::all();
        $levels = Level::orderBy('number', 'asc')->get();
        $reviews = Review::whereCourseId($id)->paginate(5);
        return view('tentor.course.detail', compact('course', 'lessons', 'levels', 'reviews'));
    }
    public function update(Request $request, $id){
        $this->validate($request, [
            'lesson_id' => 'required|max:200000000|numeric',
            'level_id' => 'required|max:200000000|numeric',
            'status' => 'required|max:20',
            'price' => 'required|max:200000000|numeric',
        ]);
        $course = Course::find($id);
        $course->update($request->all());
        // Course::whereId($id)->update($request->all());
        return redirect()->back()->with('success', 'Data berhasil di update.');
    }
}
