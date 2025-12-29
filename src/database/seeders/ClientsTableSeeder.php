<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            "name" => "北海道建設庁",
            "answer_address1" => "北海道開発部局長",
            "answer_address2" => "北海道開発建設庁",
            "numbering_name" => "北建特車",
            "fax_address1" => "北海道開建設庁 札幌部",
            "fax_address3" => "特殊車両通行許可担当窓口担当",
            "fax" => "011-611-0000",
            "tel" => "011-612-1234",
            "short_name" => "北海道開発",
            "prefecture_code" => 1,
            "hidden" => false,
        ];
        DB::table("clients")->insert($param);

        $param = [
            "name" => "盛岡河川国道事務所",
            "answer_address1" => "東北地方整備局長",
            "answer_address2" => "盛岡河川国道事務所長",
            "numbering_name" => "特国東整盛道管一道",
            "fax_address1" => "国土交通省 東北地方整備局",
            "fax_address2" => "盛岡河川国道事務所",
            "fax_address3" => "特殊車両通行許可担当窓口担当",
            "fax" => "020-456-1200",
            "tel" => "020-456-1230",
            "short_name" => "盛岡河川国道",
            "prefecture_code" => 3,
            "hidden" => false,
        ];
        DB::table("clients")->insert($param);

        $param = [
            "name" => "さいたま県",
            "answer_address1" => "さいたま県知事",
            "answer_address2" => "さいたま県県士整備部道路課",
            "numbering_name" => "道環",
            "fax_address1" => "さいたま県 県士整備部 道路環境課",
            "fax_address3" => "保全部 管理担当",
            "fax" => "048-830-1429",
            "tel" => "048-831-5180",
            "short_name" => "さいたま県",
            "prefecture_code" => 11,
            "hidden" => false,
        ];
        DB::table("clients")->insert($param);

        $param = [
            "name" => "江戸国道事務所",
            "answer_address1" => "関東地方整備局長",
            "answer_address2" => "江戸国道事務所長",
            "numbering_name" => "江国交特車",
            "fax_address1" => "国土交通省 関東地方整備局",
            "fax_address2" => "江戸国道事務所",
            "fax_address3" => " 特殊車両通行許可申請窓口担当",
            "fax" => "03-3512-9000",
            "tel" => "03-3512-9100",
            "short_name" => "江戸国道",
            "prefecture_code" => 13,
            "hidden" => false,
        ];
        DB::table("clients")->insert($param);

        $param = [
            "name" => "川崎中原市",
            "answer_address1" => "川崎中原市長",
            "answer_address2" => "建設局道路河川管理部道路課",
            "numbering_name" => "7川建道",
            "fax_address1" => "川崎中原市建設局 道路河川管理部 道路課",
            "fax_address3" => " 特殊車両担当",
            "fax" => "044-200-2800",
            "tel" => "044-200-4010",
            "short_name" => "川崎中原市",
            "prefecture_code" => 14,
            "hidden" => false,
        ];
        DB::table("clients")->insert($param);

        $param = [
            "name" => "長崎河川国道",
            "answer_address1" => "九州地方整備局長",
            "answer_address2" => "長崎河川国道事務所長",
            "numbering_name" => "国九整長特協",
            "fax_address1" => "国土交通省 九州地方整備局",
            "fax_address2" => "長崎河川国道事務所",
            "fax_address3" => "管理第一課 特殊車両担当",
            "fax" => "095-860-5660",
            "tel" => "095-860-5770",
            "short_name" => "長崎河川国道",
            "prefecture_code" => 42,
            "hidden" => false,
        ];
        DB::table("clients")->insert($param);
    }
}
