<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionPeriod extends Model
{
    protected $fillable = [
        'name',
    ];

    public function counter()
    {
        return $this->hasOne(Counter::class);
    }
}
