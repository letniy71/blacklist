<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Blacklists extends Model
{
    use HasFactory;

    public function advertiser()
    {
        return $this->hasMany('App\Models\Advertisers','id','advertiser_id');
    }

    public function publisher()
    {
        return $this->hasMany('App\Models\Publishers','id','publisher_id');
    }

    public function site()
    {
        return $this->hasMany('App\Models\Sites','id','site_id');
    }

}
