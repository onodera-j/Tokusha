<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Client;
use App\Models\Route;
use App\Models\Condition;
use App\Models\AnswerDocumentSetting;
use App\Models\StaffMember;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\StoreRouteRequest;
use App\Http\Requests\StoreConditionRequest;
use App\Http\Requests\StoreStaffMemberRequest;
use App\Http\Requests\AnswerSettingRequest;

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
    //相手先詳細内容変更
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

    //登録路線詳細
    public function routeEdit(Request $request){
        $id = $request->id;
        $route = Route::find($id);

        return view("route.route_edit", compact("route"));
    }

    //路線詳細内容変更
    public function routeUpdate(StoreRouteRequest $request, Route $route){
        DB::transaction(function () use ($request, $route) {
            $route->update($request->validated());
            });

            return redirect("/routelist")->with("success", "登録情報を更新しました");
    }

    //路線新規登録ページの表示
    public function routeCreate(){

        $user = Auth::user();

        return view("route.route_create");
    }

    //路線新規登録
    public function routeStore(StoreRouteRequest $request){
        DB::beginTransaction();
        try{

            Route::create($request->validated());

            DB::commit();

            return redirect("/routelist")->with("success", "新規登録が完了しました");

        }catch(\Exception $e) {
            DB::rollback();
            Log::error("Error: " . $e->getMessage());
            return back()->withErrors(["error", "エラーが発生しました"]);
        }
    }

    //路線削除
    public function routeDestroy(Route $route){
        $route->update([
            "delete_flags" => 1,
        ]);
        return redirect("/routelist");
    }

    //通行条件一覧ページの表示
    public function conditionList() {

        $conditions = Condition::where('delete_flags', 0)
                ->orderBy('conditioncategory_id', 'asc')
                ->orderByRaw('flag IS NULL')
                ->orderBy('flag', 'asc')
                ->orderByRaw('sort_order IS NULL')
                ->orderBy('sort_order', 'asc')
                ->get();

        return view("condition.conditionlist", compact('conditions'));
    }

    //通行条件詳細
    public function conditionEdit(Request $request){
        $id = $request->id;
        $condition = Condition::find($id);

        return view("condition.condition_edit", compact("condition"));
    }

    //通行条件詳細内容変更
    public function conditionUpdate(StoreConditionRequest $request, Condition $condition){
        DB::transaction(function () use ($request, $condition) {
            $condition->update($request->validated());
            });

            return redirect("/conditionlist")->with("success", "登録情報を更新しました");
    }

    //通行条件新規登録ページの表示
    public function conditionCreate(){

        $user = Auth::user();

        return view("condition.condition_create");
    }

    //通行条件新規登録
    public function conditionStore(StoreConditionRequest $request){
        DB::beginTransaction();
        try{

            Condition::create($request->validated());

            DB::commit();

            return redirect("/conditionlist")->with("success", "新規登録が完了しました");

        }catch(\Exception $e) {
            DB::rollback();
            Log::error("Error: " . $e->getMessage());
            return back()->withErrors(["error", "エラーが発生しました"]);
        }
    }

    //通行条件削除
    public function conditionDestroy(Condition $condition){

        $condition->update([
            "delete_flags" => 1,
        ]);
        return redirect("/conditionlist");
    }

    //基本情報ページ
    public function baseData(){

        $answersetting = AnswerDocumentSetting::sole();
        $members = StaffMember::where("delete_flags",0)->get();

        return view("basedata.basedata", compact("answersetting","members"));
    }
    //回答書情報更新
    public function answerSettingUpdate(AnswerSettingRequest $request, AnswerDocumentSetting $answersetting){
        DB::transaction(function () use ($request, $answersetting) {
            $answersetting->update($request->validated());
            });

            return redirect("/basedata")->with("success", "回答書情報を更新しました");
    }
    //担当者削除
    public function staffDestroy(StaffMember $member){

        $member->update([
            "delete_flags" => 1,
        ]);
        return redirect("/basedata")->with("success", "担当者を削除しました");;
    }
    //担当者新規登録
    public function staffStore(StoreStaffMemberRequest $request){
        DB::beginTransaction();
        try{

            StaffMember::create($request->validated());

            DB::commit();

            return redirect("/basedata")->with("success", "担当者登録しました");

        }catch(\Exception $e) {
            DB::rollback();
            Log::error("Error: " . $e->getMessage());
            return back()->withErrors(["error", "エラーが発生しました"]);
        }
    }
}
