<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $guarded = [];

    public function sections()
    {
        return $this->hasMany(ServiceSection::class, 'service_id');
    }
}
