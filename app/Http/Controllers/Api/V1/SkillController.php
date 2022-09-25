<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\SkillCollection;
use App\Http\Resources\Api\V1\SkillResource;
use App\Models\Skill;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SkillController extends Controller
{
    public function index(){
        $skills = Skill::paginate(10);
        return response()->json([
            'message' => 'Success',
            'status_code' => 200,
            'data' => new SkillCollection($skills),
        ], Response::HTTP_OK);
    }

    public function store(Request $request){
        $this->_validation($request);
        $checkSkill = Skill::where(['user_id' => $request->user_id, 'course_id' => $request->course_id, 'level_id' => $request->level_id])->first();
        if($checkSkill && $checkSkill->status != 'Deleted'){
            return response()->json([
                'message' => 'Failed!, Data already use.',
                'status_code' => 500,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }elseif($checkSkill && $checkSkill->status == 'Deleted'){
            $checkSkill->update(['status' => 'Enabled', 'price' => $request->price]);
            return response()->json([
                'message' => 'Success',
                'status_code' => 201,
                'data' => new SkillResource($checkSkill),
            ], Response::HTTP_CREATED);
        }
        $skill = Skill::create($request->all());
        return response()->json([
            'message' => 'Success',
            'status_code' => 201,
            'data' => new SkillResource($skill),
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id){
        $this->_validation($request);
        $skill = Skill::find($id);
        $skill->update($request->all());
        return response()->json([
            'message' => 'Success',
            'status_code' => 200,
            'data' => new SkillResource($skill),
        ], Response::HTTP_OK);  
    }

    public function destroy(Request $request, $id){
        $skill = Skill::find($id);
        $skill->update(['status' => $request->status]);
        return response()->json([
            'message' => 'Success, Data Successfully '.$request->status,
            'status_code' => 200,
        ], Response::HTTP_OK);
    }

    private function _validation(Request $request){
        return $this->validate($request, [
            'user_id' => 'required|numeric|max:200000000',
            'course_id' => 'required|numeric|max:200000000',
            'level_id' => 'required|numeric|max:200000000',
            'price' => 'required|numeric|max:200000000',
        ]);
    }
}
