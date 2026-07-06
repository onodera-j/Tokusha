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
            "position" => "渋山区長",
            "administrator_name" => "山田 太郎",
            "department" => "渋山区 土木部 道路管理課 管理係",
            "tel" => "00-0000-0000",
            "extension" => "2222"
        ];
        DB::table("answer_document_settings")->insert($param);
    }
}
