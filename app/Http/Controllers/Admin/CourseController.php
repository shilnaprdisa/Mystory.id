<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(){
        $courses = Course::paginate(10);
        return view('admin.course.index', compact('courses'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255|unique:courses'
        ]);
        $course = Course::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }
}
