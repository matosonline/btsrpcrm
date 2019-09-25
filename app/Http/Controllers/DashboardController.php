<?php

namespace App\Http\Controllers;

use App\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(Auth::user()->hasRole('agent-user')){
            $leads = Lead::where('agent',Auth::user()->id)->get()->toArray();
        }else{
            $leads = Lead::all()->toArray();
        }
        
        return view('/dashboard', compact('leads'));
    }
}
