<?php

namespace App\Http\Controllers\Tentor;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(){
        $reviews = Review::whereIn('course_id', auth()->user()->courses->pluck('id'))->paginate(10);
        return view('tentor.review.index', compact('reviews'));
    }
    public function update(Request $request){
        if($request->type == 'comment'){
            $this->validate($request, [
                'id' => 'required|max:200000000|numeric',
                'comment' => 'max:2000|required',
            ]);
            Review::whereId($request->id)->update(['comment' => $request->comment]);
            return redirect()->back()->with('reply', 'Balasan terkirim');
        }
        $this->validate($request, [
            'id' => 'required|max:200000000|numeric',
            'reply' => 'max:2000|required'
        ]);
        Review::whereId($request->id)->update(['reply' => $request->reply]);
        return redirect()->back()->with('reply', 'Balasan terkirim');
    }
}
