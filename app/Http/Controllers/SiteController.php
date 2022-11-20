<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\City;
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
        $tentors = User::whereRole('Tentor')->paginate(9);
        $courses = Course::paginate(9);
        $students = User::whereRole('Student')->count();
        return view('home', compact('lessons', 'tentors', 'courses', 'students'));
    }
    public function courses(Request $request){
        $lessons = Lesson::all();
        $levels = Level::all();
        $populars = Course::whereIn('id', DB::table('transactions')->select('course_id', DB::raw('count(*) as total'))
            ->groupBy('course_id')
            ->orderBy('total', 'desc')
            ->take(5)->pluck('course_id'))->get();
        $courses = Course::paginate(9);
        if($request->lesson && !$request->search && !$request->level && !$request->city){
            $courses = Course::whereLessonId($request->lesson)->paginate(9);
        }elseif($request->lesson && !$request->search && !$request->level && $request->city){
            $courses = Course::whereLessonId($request->lesson)
                ->whereIn('user_id', Address::whereCityId($request->city)->pluck('user_id'))
                ->paginate(9);
        }elseif(!$request->lesson && $request->search && !$request->level && !$request->city){
            $courses = Course::whereIn('lesson_id', Lesson::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->orWhereIn('level_id', Level::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->orWhereIn('user_id', User::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->paginate(9);
        }elseif(!$request->lesson && $request->search && !$request->level && $request->city){
            $courses = Course::whereIn('lesson_id', Lesson::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->whereIn('user_id', Address::whereCityId($request->city)->pluck('user_id'))
                ->orWhereIn('level_id', Level::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->orWhereIn('user_id', User::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->paginate(9);
        }elseif($request->lesson && $request->search && !$request->level && !$request->city){
            $courses = Course::whereLessonId($request->lesson)
                ->whereIn('level_id', Level::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->orWhereIn('user_id', User::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->paginate(9);
        }elseif($request->lesson && $request->search && !$request->level && $request->city){
            $courses = Course::whereLessonId($request->lesson)
                ->whereIn('level_id', Level::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->whereIn('user_id', Address::whereCityId($request->city)->pluck('user_id'))
                ->orWhereIn('user_id', User::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->paginate(9);
        }elseif(!$request->lesson && $request->search && $request->level && !$request->city){
            $courses = Course::whereLevelId($request->level)
                ->whereIn('lesson_id', Lesson::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->orWhereIn('user_id', User::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->paginate(9);
        }elseif(!$request->lesson && $request->search && $request->level && $request->city){
            $courses = Course::whereLevelId($request->level)
                ->whereIn('lesson_id', Lesson::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->whereIn('user_id', Address::whereCityId($request->city)->pluck('user_id'))
                ->orWhereIn('user_id', User::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->paginate(9);
        }elseif($request->lesson && $request->search && $request->level && !$request->city){
            $courses = Course::whereLevelId($request->level)
                ->whereLessonId($request->lesson)
                ->whereIn('user_id', User::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->paginate(9);
        }elseif($request->lesson && $request->search && $request->level && $request->city){
            $courses = Course::whereLevelId($request->level)
                ->whereLessonId($request->lesson)
                ->whereIn('user_id', User::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id'))
                ->whereIn('user_id', Address::whereCityId($request->city)->pluck('user_id'))
                ->paginate(9);
        }elseif(!$request->lesson && !$request->search && $request->level && !$request->city){
            $courses = Course::whereLevelId($request->level)->paginate(9);
        }elseif(!$request->lesson && !$request->search && $request->level && $request->city){
            $courses = Course::whereLevelId($request->level)->whereIn('user_id', Address::whereCityId($request->city)->pluck('user_id'))->paginate(9);
        }elseif($request->lesson && !$request->search && $request->level && !$request->city){
            $courses = Course::whereLevelId($request->level)->whereLessonId($request->lesson)->paginate(9);
        }elseif($request->lesson && !$request->search && $request->level && $request->city){
            $courses = Course::whereLevelId($request->level)->whereLessonId($request->lesson)->whereIn('user_id', Address::whereCityId($request->city)->pluck('user_id'))->paginate(9);
        }elseif(!$request->lesson && !$request->search && !$request->level && $request->city){
            $courses = Course::whereIn('user_id', Address::whereCityId($request->city)->pluck('user_id'))->paginate(9);
        }
        // dd($courses);
        return view('course', compact('courses', 'populars', 'lessons', 'levels'));
    }
    public function detail($id){
        $course = Course::find($id);
        $reviews = Review::whereCourseId($id)->paginate(5);
        $tentor_courses = Course::whereUserId($course->user_id)->pluck('id');
        $tentor_reviews = Review::whereIn('course_id', $tentor_courses)->count();
        $tentor_rating = [
            'reviews' => $tentor_reviews,
            'rating' => Review::whereIn('course_id', $tentor_courses)->sum('rating') ?? 0 / $tentor_reviews
        ];
        return view('course_detail', compact('course', 'reviews', 'tentor_rating'));
    }
    public function invoice($id){
        $transaction = Transaction::find($id);
        return view('invoice', compact('transaction'));
    }
}
