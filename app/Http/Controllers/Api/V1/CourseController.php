<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CourseCollection;
use App\Http\Resources\Api\V1\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    public function index(){
        $courses = Course::paginate(10);
        return response()->json([
            'message' => 'Success',
            'status_code' => 200,
            'data' => new CourseCollection($courses),
        ], Response::HTTP_OK);
    }

    public function store(Request $request){
        $this->_validation($request);
        $checkCourse = Course::where(['user_id' => $request->user_id, 'lesson_id' => $request->lesson_id, 'level_id' => $request->level_id])->first();
        if($checkCourse && $checkCourse->status != 'Deleted'){
            return response()->json([
                'message' => 'Failed!, Data already use.',
                'status_code' => 500,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }elseif($checkCourse && $checkCourse->status == 'Deleted'){
            $checkCourse->update(['status' => 'Enabled', 'price' => $request->price]);
            return response()->json([
                'message' => 'Success',
                'status_code' => 201,
                'data' => new CourseResource($checkCourse),
            ], Response::HTTP_CREATED);
        }
        $course = Course::create($request->all());
        return response()->json([
            'message' => 'Success',
            'status_code' => 201,
            'data' => new CourseResource($course),
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id){
        $this->_validation($request);
        $course = Course::find($id);
        $course->update($request->all());
        return response()->json([
            'message' => 'Success',
            'status_code' => 200,
            'data' => new CourseResource($course),
        ], Response::HTTP_OK);  
    }

    public function destroy(Request $request, $id){
        $course = Course::find($id);
        $course->update(['status' => $request->status]);
        return response()->json([
            'message' => 'Success, Data Successfully '.$request->status,
            'status_code' => 200,
        ], Response::HTTP_OK);
    }

    private function _validation(Request $request){
        return $this->validate($request, [
            'user_id' => 'required|numeric|max:200000000',
            'lesson_id' => 'required|numeric|max:200000000',
            'level_id' => 'required|numeric|max:200000000',
            'price' => 'required|numeric|max:200000000',
        ]);
    }
}
