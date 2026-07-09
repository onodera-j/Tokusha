<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerbaseRemark extends Model
{
    protected $fillable = [
        'answerbase_id',
        'answer_remarks',
        'fax_remarks',
    ];

    public function answerbases()
    {
        return $this->belongsTo(Answerbase::class, 'answerbase_id');
    }
}
