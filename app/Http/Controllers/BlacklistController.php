<?php

namespace App\Http\Controllers;
use App\Classes\Blacklists;
use Illuminate\Http\Request;

class BlacklistController extends Controller
{
   public function save(){
      try{
         // Если метод save()  возвращает true 
         $blacklist = Blacklists::save('p222,s4',2);
      } catch (Exception $e) {
      // Если false - ловим брошенное из модели исключение 
         echo $e->getMessage();
      }
    }

    public function get(){

    $blacklist = Blacklists::get(2);
        echo $blacklist;
    }
}
