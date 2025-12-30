<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Client;
use App\Http\Requests\StoreClientRequest;

class ListController extends Controller
{
    //相手先一覧ページの表示
    public function clientList() {

        $user = Auth::user();
        $clients = Client::orderBy('prefecture_code', 'asc')->get();

        return view("client.clientlist", compact('user','clients'));
    }
    //相手先登録ページの表示
    public function clientCreate(){

        $user = Auth::user();

        return view("client.client_create");
    }
    //相手先新規登録
    public function clientStore(StoreClientRequest $request){
        DB::beginTransaction();
        try{

            Client::create($request->validated());

            DB::commit();

            return redirect("/clientlist")->with("success", "新規登録が完了しました");

        }catch(\Exception $e) {
            DB::rollback();
            Log::error("Error: " . $e->getMessage());
            return back()->withErrors(["error", "エラーが発生しました"]);
        }
    }




}
