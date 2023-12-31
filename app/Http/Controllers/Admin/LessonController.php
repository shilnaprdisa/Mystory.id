<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
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
    public function edit($id){
        $lesson = Lesson::find($id);
        return view('admin.lesson.edit', compact('lesson'));
    }
    public function update(Request $request,$id){        
        $name = 'required|max:255|unique:lessons';        
        if($request->old_name == $request->name){
            $name = 'required|max:255';   
        }
        $this->validate($request, [
            'name' => $name,
            'image' => 'mimes:jpg,png,jpeg,gif'
        ]);
        $lesson = Lesson::find($id);            
        if($request->hasFile('image')){
            $lesson->clearMediaCollection('lessons');
            $lesson->addMediaFromRequest('image')->toMediaCollection('lessons');
        }
        $lesson->update($request->only('name'));
        return redirect()->back()->with('success', 'Data berhasil diupdate.');
    }
    public function destroy($id){
        $course = Course::where('lesson_id', $id)->first();
        if($course){
            return redirect()->back()->with('failed', 'Gagal menghapus, Pelajaran sedang digunakan.');
        }
        $lesson = Lesson::find($id);
        $lesson->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
