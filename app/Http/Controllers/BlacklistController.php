<?php

namespace App\Http\Controllers;
use App\Classes\Blacklists;
use Illuminate\Http\Request;

class BlacklistController extends Controller
{
   public function show(){

    $blacklist = Blacklists::save('p1,s2,s3,s6,s5',1);
        //return view('show',['blacklist'=>$blacklist]);
    }

    public function get(){

    $blacklist = Blacklists::get(2);
        return view('show',['blacklist'=>$blacklist]);
    }
}
