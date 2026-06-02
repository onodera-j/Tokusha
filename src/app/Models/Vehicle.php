<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'answerbase_id',
        'application_number',
        'weight',
        'length',
        'width',
        'height',
        'radius',
    ];

    public function answerbases()
    {
        return $this->belongsTo(Answerbase::class, 'answerbase_id');
    }
}
