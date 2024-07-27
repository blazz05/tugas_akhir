<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogActivityController extends Controller
{
    public function index()
    {
        $ar_logactivity = Activity::with('causer')->latest()->get();

        return view('logactivity', [
            'ar_logactivity' => $ar_logactivity
        ]);
    }
}
