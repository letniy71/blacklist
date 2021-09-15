<?php

namespace App\Http\Controllers;
use App\Classes\Blacklists;
use Illuminate\Http\Request;

class BlacklistController extends Controller
{
   public function show(){

    $blacklist = Blacklists::save('p1,s1,p2,s1',4);
        //return view('show',['blacklist'=>$blacklist]);
    }

    public function get(){

    $blacklist = Blacklists::get(2);
        return view('show',['blacklist'=>$blacklist]);
    }
}
