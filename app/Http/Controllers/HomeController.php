<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class HomeController extends Controller
{
    /**
     * Display the homepage
     *
     * @return \Illuminate\Http\Response
    */
    public function index(){
        return view('welcome');
    }

    /**
     * Set the requested language
     *
     * @return \Illuminate\Http\Response
    */
    public function changeLang(Request $request){
        if($request->lang){
            App::setLocale($request->lang);
            session()->put('locale', $request->lang);
            return redirect()->back();
        }
        else{
            return redirect()->back();
        }
    }
}
