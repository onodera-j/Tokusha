<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RouteCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            "name" => "採択路線",
        ];
        DB::table("route_categories")->insert($param);

        $param = [
            "name" => "特車線",
        ];
        DB::table("route_categories")->insert($param);

        $param = [
            "name" => "特別区道1～299",
        ];
        DB::table("route_categories")->insert($param);

        $param = [
            "name" => "特別区道300～599",
        ];
        DB::table("route_categories")->insert($param);

        $param = [
            "name" => "特別区道600～899",
        ];
        DB::table("route_categories")->insert($param);

        $param = [
            "name" => "特別区道900～",
        ];
        DB::table("route_categories")->insert($param);

        $param = [
            "name" => "経路",
        ];
        DB::table("route_categories")->insert($param);
    }
}
