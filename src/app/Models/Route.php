<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'routecategory_id',
        'name',
        'remarks',
        'short_name',
        'short_number',
        'delete_flags',
    ];

    public function routeCategory()
    {
        return $this->belongsTo(RouteCategory::class);
    }
}
