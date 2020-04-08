<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{
    public function index(){

        $files = Storage::allFiles('/public/img/site-header');
        $randomImage = asset('storage/img/site-header/').'/'.array_rand($files).'.jpg';

        return view('welcome', compact('randomImage', 'files'));

    }
}
