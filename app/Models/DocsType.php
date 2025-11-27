<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocsType extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function documnet(){
      return $this->hasMany(Document::class,'type_id');
    }   
}
