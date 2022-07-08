<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardPageController extends Controller
{
    public function index()
    {
        return view('dashboard.site.home');
    }
}
