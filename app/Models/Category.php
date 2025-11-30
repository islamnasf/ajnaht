<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function reservations(){
      return $this->hasMany(Reservation::class,'hotel_id');
    }
       public function prices(){
      return $this->hasMany(Price::class,'category_id');
    }
      public function files(){
      return $this->hasMany(File::class,'category_id');
    }
}
