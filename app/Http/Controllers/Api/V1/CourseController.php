<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CourseCollection;
use App\Http\Resources\Api\V1\CourseResource;
use App\Models\Course;
use App\Models\Skill;
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

    public function destroy($id){
        $course = Course::find($id);
        $skill = Skill::where('course_id', $id)->first();
        if($skill){
            return response()->json([
                'message' => 'Failed, Course is used',
                'status_code' => 500,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $course->delete();
        return response()->json([
            'message' => 'Success',
            'status_code' => 200,
        ], Response::HTTP_OK);
    }

    private function _validation(Request $request){
        return $this->validate($request, [
            'name' => 'required|max:255'
        ]);
    }
}
