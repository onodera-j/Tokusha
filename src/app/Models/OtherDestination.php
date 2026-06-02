<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherDestination extends Model
{
    protected $fillable = [
        'answerbase_id',
        'second_destination',
    ];

    public function answerbase()
    {
        return $this->belongsTo(Answerbase::class, 'answerbase_id');
    }
}
