<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'short_name',
        'prefecture_code',
        'tel',
        'fax',
        'answer_address1',
        'answer_address2',
        'numbering_name',
        'fax_address1',
        'fax_address2',
        'fax_address3',
        'hidden',
    ];
}
