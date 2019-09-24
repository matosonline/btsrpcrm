<?php

namespace App\Http\Controllers;

use App\Lead;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leads = lead::all()->toArray();
        return view('/dashboard', compact('leads'));
    }
}
