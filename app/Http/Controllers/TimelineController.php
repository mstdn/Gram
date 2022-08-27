<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Dashboard');
    }

    public function home()
    {
        return Inertia::render('Timeline/Home');
    }
}
