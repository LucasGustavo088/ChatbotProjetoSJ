<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home() {
        return view('dashboard.home');
    }

    public function atendimento() {
        return view('dashboard.atendimento');
    }

    
}
