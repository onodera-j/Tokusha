<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerDocumentSetting extends Model
{

    protected $fillable = [
            'numbering_name',
            'answer_year',
            'position',
            'administrator_name',
            'department',
            'tel',
            'fax',
            'extension',
            'postcode',
            'address',

    ];

}
