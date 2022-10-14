<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function index(){
        $wd = Withdrawal::paginate(10);
        return view('admin.wd.index', compact('wd'));
    }
}
