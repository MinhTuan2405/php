<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;  


class TeamsController extends Controller
{
    //
    public function index(): View
    {
        return view('teams');
    }
}
