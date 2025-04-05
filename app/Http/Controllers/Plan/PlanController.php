<?php

declare(strict_types=1);

namespace App\Http\Controllers\Plan;

use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    public function index()
    {
        return view('plan.index');
    }
}
