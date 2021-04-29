<?php

namespace App\Http\Controllers;

use App\Mail\SkillshopMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Inertia\Inertia;

class SkillshopController extends Controller
{
    function index()
    {
        return Inertia::render('SkillShop/index');
    }

    function show(Request $request)
    {

        //dd($request);
        $request->validate([
            'encSysid'     =>  'required',
            'encApikey'    =>  'required'  
        ]);

        return Inertia::render('SkillShop/show', 
        $request->validate([
            'encSysid'     =>  'required',
            'encApikey'    =>  'required'  
        ]));

    

    }

    function submit(Request $request){
        //dd($request);

        $params = $request->json();
        
        $request->validate([
            'sysid'             => 'required',
            'productName'       => 'required',
            'overview'          => 'required',
            'selectedCourses'   => 'required',
            'pricePoints'       => 'required',
            'sme'               => 'required',
            'bio'               => 'required',
            'imgLink'           => 'required'
        ]);
        

       //Mail::to('chrishcodes@gmail.com')->send(new SkillshopMailer($request));

       
    }
       
    
}