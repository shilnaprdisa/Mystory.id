<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index(){
        $levels = Level::paginate(10);
        return view('admin.level.index', compact('levels'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'number' => 'required|numeric|max:200000000|unique:levels',
            'roman' => 'required|max:255|unique:levels',
        ]);
        $levels = Level::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }
}
