<?php

namespace App\Http\Controllers\Tentor;

use App\Http\Controllers\Controller;
use App\Models\Earning;
use Illuminate\Http\Request;

class EarningController extends Controller
{
    public function index(){
        $earnings = Earning::whereUserId(auth()->user()->id)->paginate(10);
        return view('tentor.earning.index', compact('earnings'));
    }
}
