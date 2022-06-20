<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class blogController extends Controller
{
    public function blogindex(){
        return view('blogView.index');
    }

    public function blogcontract(){
        return view('blogView.contract');
    }
}
