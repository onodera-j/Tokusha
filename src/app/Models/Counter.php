<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $fillable = [
        'answerbase_id',
        'name',
        'permission_period',
    ];

    public function answerbase()
    {
        return $this->belongsTo(Answerbase::class, 'answerbase_id');
    }

    public function permissionperiod()
    {
        return $this->belongsTo(PermissionPeriod::class, 'permission_period_id');
    }
}
