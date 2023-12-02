<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\LessonCollection;
use App\Http\Resources\Api\V1\LessonResource;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonController extends Controller
{
    public function index(){
        $lessons = Lesson::paginate(10);
        return response()->json([
            'message' => 'Success',
            'status_code' => 200,
            'data' => new LessonCollection($lessons),
        ], Response::HTTP_OK);
    }

    public function store(Request $request){
        $this->_validation($request);
        $lesson = Lesson::create($request->all());
        return response()->json([
            'message' => 'Success',
            'status_code' => 201,
            'data' => new LessonResource($lesson),
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id){
        $this->_validation($request);
        $lesson = Lesson::find($id);
        $lesson->update($request->all());
        return response()->json([
            'message' => 'Success',
            'status_code' => 200,
            'data' => new LessonResource($lesson),
        ], Response::HTTP_OK);  
    }

    public function destroy($id){
        $course = Course::where('lesson_id', $id)->first();
        if($course){
            return response()->json([
                'message' => 'Failed, Lesson is used',
                'status_code' => 500,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $lesson = Lesson::find($id);
        $lesson->delete();
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
