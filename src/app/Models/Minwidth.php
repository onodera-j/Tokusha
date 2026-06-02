<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Minwidth extends Model
{
    protected $fillable = [
        'answerbase_id',
        'road_condition',
        'road_name',
        'min_width',
        'width_condition',
    ];

    public function answerbases()
    {
        return $this->belongsTo(Answerbase::class, 'answerbase_id');
    }
}
