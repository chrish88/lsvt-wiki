<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Inertia\Inertia;

class HomeController extends Controller
{
    function index()
    {
        return Inertia::render('Auth/Login');

    }

    // function show(Request $request)
    // {
    //     $request->validate([
    //         'sysid'     =>  'required',
    //         'apikey'    =>  'required'  
    //     ]);

    //     $sysid  = request('sysid');
    //     $apikey = request('apikey');

    //     return Inertia::render('/skillshop/form', compact('sysid', 'apikey'));

    

    // }
       
    
}