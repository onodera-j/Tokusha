<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffMember extends Model
{

    protected $fillable = [
            'name',
            'delete_flags',
    ];
}
