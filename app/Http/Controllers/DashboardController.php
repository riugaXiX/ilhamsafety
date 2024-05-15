<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flame;

class DashboardController extends Controller
{
    //
    public function index(){
        $totaldata = Flame::count();

        return view('admin.pages.dashboard',[
            "title" => 'dashboard',
            "totaldata" => $totaldata
        ]);
    }
}
