<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class DashboardPageController extends Controller
{
    public function index()
    {
        abort_if(!auth()->user()->can('access_dashboard'),Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('dashboard.site.home');
    }
}
