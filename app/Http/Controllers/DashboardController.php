<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            return view('dashboard');
        } else {
            return view('dashboard2');
        }
    }
}
