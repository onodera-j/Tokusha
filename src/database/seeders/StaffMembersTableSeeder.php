<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            "name" => "小野寺",
        ];
        DB::table("staff_members")->insert($param);

        $param = [
            "name" => "吉田",
        ];
        DB::table("staff_members")->insert($param);

        $param = [
            "name" => "丸山",
        ];
        DB::table("staff_members")->insert($param);

        $param = [
            "name" => "加藤",
        ];
        DB::table("staff_members")->insert($param);
    }
}
