<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerbaseFreeNotCondition extends Model
{
    protected $fillable = [
        'answerbase_id',
        'category',
        'condition_free',
    ];

    public function answerbases()
    {
        return $this->belongsToMany(Answerbase::class, 'answerbase_id');
    }
}
