<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListController extends Controller
{
    public function clientList() {
        return view("client.clientlist");
    }

}
