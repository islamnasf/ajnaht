<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSection extends Model
{
    protected $guarded = [];
    public function section()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
