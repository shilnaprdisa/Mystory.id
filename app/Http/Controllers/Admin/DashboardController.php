<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return 'halaman customer';
    }
    public function tentor(){
        return 'halaman tentor';
    }
    public function admin(){
        return view('admin.dashboard.index');
    }
}
