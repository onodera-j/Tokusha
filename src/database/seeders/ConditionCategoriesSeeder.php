<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            "name" => "幅員",
        ];
        DB::table("condition_categories")->insert($param);

        $param = [
            "name" => "折進",
        ];
        DB::table("condition_categories")->insert($param);

        $param = [
            "name" => "通学路",
        ];
        DB::table("condition_categories")->insert($param);

        $param = [
            "name" => "注意事項",
        ];
        DB::table("condition_categories")->insert($param);

        $param = [
            "name" => "土木部協議",
        ];
        DB::table("condition_categories")->insert($param);

        $param = [
            "name" => "警察協議",
        ];
        DB::table("condition_categories")->insert($param);

        $param = [
            "name" => "バス",
        ];
        DB::table("condition_categories")->insert($param);

        $param = [
            "name" => "特殊条件",
        ];
        DB::table("condition_categories")->insert($param);

        $param = [
            "name" => "必須",
        ];
        DB::table("condition_categories")->insert($param);
    }
}
