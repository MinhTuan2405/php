<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\View\View;  

class DashBoardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', ['courses' => Course::all()]);
    }
}
