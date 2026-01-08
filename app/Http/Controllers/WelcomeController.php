<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;  


class WelcomeController extends Controller
{
    //
    public function index(): View
    {
        return view('welcome', ['courses' => Course::all()]);
    }
}
