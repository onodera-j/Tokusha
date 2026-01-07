<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Client;
use App\Models\Route;
use App\Http\Requests\StoreClientRequest;

class ListController extends Controller
{
    //相手先一覧ページの表示
    public function clientList() {

        $user = Auth::user();
        $clients = Client::where('hidden', 0)
            ->orderBy('prefecture_code', 'asc')->get();

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
    //相手先詳細
    public function clientEdit(Request $request){
        $id = $request->id;
        $client = Client::find($id);

        return view("client.client_edit", compact("client"));
    }
    //詳細内容変更
    public function clientUpdate(StoreClientRequest $request, Client $client){
        DB::transaction(function () use ($request, $client) {
            $client->update($request->validated());
            });

            return redirect("/clientlist")->with("success", "登録情報を更新しました");
    }
    //非表示一覧
    public function clientHidden() {

        $user = Auth::user();
        $clients = Client::where('hidden', 1)
            ->orderBy('prefecture_code', 'asc')->get();

        return view("client.client_hidden", compact('user','clients'));
    }
    //非表示
    public function clientHide(Client $client){

        $client->update([
            "hidden" => 1,
        ]);
        return redirect("/clientlist");
    }


    //再表示
    public function clientUnhide(Client $client){

        $client->update([
            "hidden" => 0,
        ]);
        return redirect("/clientlist/hidden");
    }

    //相手先削除
    public function clientDestroy(Client $client){
        $client->delete();
        return redirect("/clientlist/hidden");
    }


    //登録路線一覧ページの表示
    public function routeList() {

        $routes = Route::where('delete_flags', 0)->get();

        return view("route.routelist", compact('routes'));
    }

}
