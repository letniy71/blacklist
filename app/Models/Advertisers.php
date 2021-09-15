<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisers extends Model
{
    use HasFactory;

     public function blacklist()
    {
        return $this->belongsTo('App\Models\Blacklists');
    }
}
 
