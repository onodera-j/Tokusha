<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answerbase extends Model
{

    protected $fillable = [
        'sheet_type',
        'numbering_name',
        'approval_number',
        'client_id',
        'application_date',
        'consultation_number',
        'destination',
        'answer_year',
        'staff_id',
        'approval_date',
    ];

    public function allowRoutes()
    {
        return $this->belongsToMany(Route::class, 'answerbase_allowed_routes', 'answerbase_id', 'route_id');
    }

    public function notAllowRoutes()
    {
        return $this->belongsToMany(Route::class, 'answerbase_not_allowed_routes', 'answerbase_id', 'route_id');
    }

    public function allowConditions()
    {
        return $this->belongsToMany(Condition::class, 'answerbase_conditions', 'answerbase_id', 'condition_id');
    }

    public function allowFreeCondition()
    {
        return $this->hasOne(AnswerbaseFreeCondition::class);
    }

    public function notAllowConditions()
    {
        return $this->belongsToMany(Condition::class, 'answerbase_not_conditions', 'answerbase_id', 'condition_id');
    }

    public function notFreeConditions()
    {
        return $this->hasMany(AnswerbaseFreeNotCondition::class);
    }

    public function counters()
    {
        return $this->hasMany(Counter::class);
    }

    public function minWidths()
    {
        return $this->hasMany(Minwidth::class);
    }

    public function otherDestinations()
    {
        return $this->hasMany(OtherDestination::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

}


