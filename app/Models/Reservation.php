<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
      protected $guarded=[];
    public function category(){
      return $this->belongsTo(Category::class,'hotel_id');
    }
    public function user(){
      return $this->belongsTo(User::class,'user_id');
    }
    
     public function details(){
      return $this->hasMany(ReserDetail::class,'reservation_id');
    }
   
}
