<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Level;
use App\Models\Review;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index(){
        $lessons = Lesson::all();
        $tentors = User::whereRole('Tentor')->paginate(2);
        $courses = Course::paginate(9);
        $students = User::whereRole('Student')->count();
        return view('home', compact('lessons', 'tentors', 'courses', 'students'));
    }
    public function courses(Request $request){
        // dd($request->all());
        $populars = Course::whereIn('id', DB::table('transactions')->select('course_id', DB::raw('count(*) as total'))
            ->groupBy('course_id')
            ->orderBy('total', 'desc')
            ->take(5)->pluck('course_id'))->get();
        $courses = Course::paginate(9);
        if($request->lesson && !$request->search){
            $courses = Course::whereLessonId($request->lesson)->paginate(9);
        }elseif(!$request->lesson && $request->search){
            $courses = Course::whereIn('lesson_id', Lesson::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->orWhereIn('level_id', Level::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->orWhereIn('user_id', User::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->paginate(2);
        }elseif($request->lesson && $request->search){
            $courses = Course::whereLessonId($request->lesson)
                ->orWhereIn('level_id', Level::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->orWhereIn('user_id', User::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->paginate(2);
        }
        // dd($courses);
        return view('course', compact('courses', 'populars'));
    }
    public function detail($id){
        $course = Course::find($id);
        $reviews = Review::whereCourseId($id)->paginate(5);
        $tentor_courses = Course::whereUserId($course->user_id)->pluck('id');
        $tentor_reviews = Review::whereIn('course_id', $tentor_courses)->count();
        $tentor_rating = [
            'reviews' => $tentor_reviews,
            'rating' => Review::whereIn('course_id', $tentor_courses)->sum('rating') / $tentor_reviews
        ];
        return view('course_detail', compact('course', 'reviews', 'tentor_rating'));
    }
}
