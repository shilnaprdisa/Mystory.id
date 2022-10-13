<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\LevelCollection;
use App\Http\Resources\Api\V1\LevelResource;
use App\Models\Level;
use App\Models\Skill;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LevelController extends Controller
{
    public function index(){
        $levels = Level::paginate(10);
        return response()->json([
            'message' => 'Success',
            'status_code' => 200,
            'data' => new LevelCollection($levels),
        ], Response::HTTP_OK);
    }

    public function store(Request $request){
        $this->_validation($request);
        $level = Level::create($request->all());
        return response()->json([
            'message' => 'Success',
            'status_code' => 201,
            'data' => new LevelResource($level),
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id){
        $this->_validation($request);
        $level = Level::find($id);
        $level->update($request->all());
        return response()->json([
            'message' => 'Success',
            'status_code' => 200,
            'data' => new LevelResource($level),
        ], Response::HTTP_OK);  
    }

    public function destroy($id){
        $level = Level::find($id);
        $skill = Skill::where('level_id', $id)->first();
        if($skill){
            return response()->json([
                'message' => 'Failed, Level is used',
                'status_code' => 500,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $level->delete();
        return response()->json([
            'message' => 'Success',
            'status_code' => 200,
        ], Response::HTTP_OK);
    }

    private function _validation(Request $request){
        return $this->validate($request, [
            'number' => 'required|numeric|max:200000000',
            'name' => 'required|max:255'
        ]);
    }
}
