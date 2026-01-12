<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    protected $fillable = [
        'conditioncategory_id',
        'flag',
        'index',
        'content',
    ];

    public function conditionCategory()
    {
        return $this->belongsTo(ConditionCategory::class);
    }
}
