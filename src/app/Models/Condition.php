<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    protected $fillable = [
        'conditioncategory_id',
        'flag',
        'sort_order',
        'content',
        'delete_flags',
    ];

    public function conditionCategory()
    {
        return $this->belongsTo(ConditionCategory::class, 'conditioncategory_id');
    }
}
