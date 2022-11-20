<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(){
        $lessons = Lesson::paginate(10);
        return view('admin.lesson.index', compact('lessons'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255|unique:lessons',
            'image' => 'mimes:jpg,png,jpeg,gif'
        ]);
        $lesson = Lesson::create($request->except('image'));     
        if($request->hasFile('image')){
            $lesson->addMediaFromRequest('image')->toMediaCollection('lessons');
        }
        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }
}
