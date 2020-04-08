<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(){
        return view('calendar');
    }

    public function edit(){
        return view('calendaredit');
    }
}
