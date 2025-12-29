<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Client;

class ListController extends Controller
{
    //相手先一覧ページの表示
    public function clientList() {

        $user = Auth::user();
        $clients = Client::orderBy('prefecture_code', 'asc')->get();

        return view("client.clientlist", compact('user','clients'));
    }

    public function clientCreate(){

        $user = Auth::user();

        return view("client.client_create");
    }



}
