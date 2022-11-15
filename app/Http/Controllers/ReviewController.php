<?php

namespace App\Http\Controllers;

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
                'rating' => 'max:5|numeric|required',
            ]);
            Review::whereId($request->id)->update(['comment' => $request->comment, 'rating' => $request->rating]);
            return redirect()->back()->with('review', 'Review terkirim');
        }
        $this->validate($request, [
            'id' => 'required|max:200000000|numeric',
            'reply' => 'max:2000|required'
        ]);
        Review::whereId($request->id)->update(['reply' => $request->reply]);
        return redirect()->back()->with('review', 'Balasan terkirim');
    }
}
