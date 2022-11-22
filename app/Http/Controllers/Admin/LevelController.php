<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index(){
        $levels = Level::orderBy('number', 'asc')->get();
        return view('admin.level.index', compact('levels'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'number' => 'required|numeric|max:200000000',
            'name' => 'required|max:255|unique:levels',
        ]);
        $levels = Level::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }
    public function edit($id){
        $level = Level::find($id);
        return view('admin.level.edit', compact('level'));
    }
    public function update(Request $request,$id){        
        $name = 'required|max:255|unique:lessons';        
        if($request->old_name == $request->name){
            $name = 'required|max:255';   
        }
        $this->validate($request, [
            'name' => $name,
            'number' => 'required|numeric|max:200000000'
        ]);
        $level = Level::find($id);
        $level->update($request->only('name', 'number'));
        return redirect()->back()->with('success', 'Data berhasil diupdate.');
    }
}
