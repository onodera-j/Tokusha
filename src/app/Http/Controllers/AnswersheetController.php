<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AnswersheetController extends Controller
{
    public function answersheetCreate(){
        return view("answersheet.answersheet_create");
    }
}
