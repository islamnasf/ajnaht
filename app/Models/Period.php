<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $guarded=[];
    public function price(){
      return $this->belongsTo(Price::class,'price_id');
    }
}
