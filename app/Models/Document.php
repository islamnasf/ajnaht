<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function files(){
      return $this->hasMany(DocsFile::class,'docs_id');
    }
    public function type(){
      return $this->belongsTo(DocsType::class,'type_id');
    }
}
