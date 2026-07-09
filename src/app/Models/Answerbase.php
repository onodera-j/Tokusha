<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function counter()
    {
        return $this->hasOne(Counter::class);
    }

    public function minWidths()
    {
        return $this->hasMany(Minwidth::class);
    }

    public function otherDestination()
    {
        return $this->hasOne(OtherDestination::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function staffs()
    {
        return $this->belongsTo(StaffMember::class, 'staff_id');
    }

    public function remark()
    {
        return $this->hasOne(AnswerbaseRemark::class);
    }

    public function getApplicationDateWarekiAttribute()
    {

        $date = Carbon::parse($this->application_date);

        // 令和の計算ロジック（どのサーバー環境でも100%動くコード）
        if ($date->gte('2019-05-01')) {
            $reiwaYear = $date->year - 2019 + 1;
            $yearStr = ($reiwaYear === 1) ? '元' : $reiwaYear;
            return "令和{$yearStr}年{$date->month}月{$date->day}日";
        }

        // 平成以前（必要に応じて追加可能）
        return $date->format('Y年m月d日');
    }

    public function getApprovalDateWarekiAttribute()
    {
        if (empty($this->approval_date)) {
            return '年　　月　　日';
        }

        $date = Carbon::parse($this->approval_date);

        // 令和の計算ロジック（どのサーバー環境でも100%動くコード）
        if ($date->gte('2019-05-01')) {
            $reiwaYear = $date->year - 2019 + 1;
            $yearStr = ($reiwaYear === 1) ? '元' : $reiwaYear;
            return "令和{$yearStr}年{$date->month}月{$date->day}日";
        }

        // 平成以前（必要に応じて追加可能）
        return $date->format('Y年m月d日');
    }

}


