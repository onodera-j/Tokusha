<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteCategory extends Model
{

    protected $fillable = [
        'name',
    ];

    public function routes()
    {
        return $this->hasMany(Route::class);
    }
}
