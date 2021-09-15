<?php

namespace App\Http\Controllers;
use App\Classes\Blacklists;
use Illuminate\Http\Request;

class BlacklistController extends Controller
{
   public function save(){

    $blacklist = Blacklists::save('p1,s2,s3,s6,s5',1);
        echo "Добавлено";
    }

    public function get(){

    $blacklist = Blacklists::get(2);
        echo $blacklist;
    }
}
