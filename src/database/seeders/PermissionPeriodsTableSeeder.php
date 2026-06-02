<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionPeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            "name" => "12ヵ月",
        ];
        DB::table("permission_periods")->insert($param);

        $param = [
            "name" => "24ヵ月",
        ];
        DB::table("permission_periods")->insert($param);

        $param = [
            "name" => "36ヵ月",
        ];
        DB::table("permission_periods")->insert($param);

        $param = [
            "name" => "48ヵ月",
        ];
        DB::table("permission_periods")->insert($param);
    }
}
