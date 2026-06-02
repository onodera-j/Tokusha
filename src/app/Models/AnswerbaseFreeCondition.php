<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerbaseFreeCondition extends Model
{
    protected $fillable = [
        'answerbase_id',
        'condition_id',
        'condition_free',
    ];

    public function answerbase()
    {
        return $this->belongsToMany(Answerbase::class, 'answerbase_id');
    }
}
