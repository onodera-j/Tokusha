<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConditionCategory extends Model
{
    protected $fillable = [
        'name',
    ];

    public function conditions()
    {
        return $this->hasMany(Condition::class);
    }
}
