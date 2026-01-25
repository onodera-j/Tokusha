<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerDocumentSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            "numbering_name" => "7渋特車許第",
            "answer_year" => "令和8年",
        ];
        DB::table("answer_document_settings")->insert($param);
    }
}
