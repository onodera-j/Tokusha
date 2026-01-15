<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            "conditioncategory_id" => 9,
            "flag" => "",
            "content"=> "許可車両の通行によって道路に損傷を与えた場合は、速やかに道路管理者に連絡し、復旧すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 1,
            "flag" => "B",
            "content"=> "当該車両は車道中央を超えての走行になるため、徐行すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 1,
            "flag" => "C",
            "sort_order" => 1,
            "content"=> "当該車両は車道中央を大幅に超えての走行になるため誘導員を配し、周囲の安全に配慮の上、徐行すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 1,
            "flag" => "C",
            "sort_order" => 2,
            "content"=> "当該車両は車道中央を大幅に超えての走行になるため誘導車を配し、周囲の安全に配慮の上、徐行すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 2,
            "flag" => "B",
            "sort_order" => 1,
            "content"=> "申請経路上の折進部分は中央線を超えての走行となるため、周囲の安全に配慮の上、徐行すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 2,
            "flag" => "C",
            "sort_order" => 1,
            "content"=> "交差点折進部分は道路中央を大幅に超えての走行になるため、誘導員を配し、徐行すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 2,
            "flag" => "C",
            "sort_order" => 2,
            "content"=> "交差点折進部分は道路中央を大幅に超えての走行になるため、誘導車を配し、徐行すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 3,
            "flag" => "a",
            "content"=> "通学路を通行するため登下校以外の時間に通行し、その他の時間帯においても徐行すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 3,
            "flag" => "b",
            "content"=> "通学路を一部通行するため登下校以外の時間に通行すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 4,
            "flag" => "a",
            "content"=> "歩道を通行する場合は、養生すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 4,
            "flag" => "b",
            "content"=> "バック走行の際は、前後に誘導員を配置し、周囲の安全に配慮すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 4,
            "flag" => "c",
            "content"=> "申請経路はバスターミナルのため、バスの運行時間帯は通行しないこと。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 4,
            "flag" => "d",
            "content"=> "申請経路は繁華街であるため誘導員を配し、歩行者に注意し徐行すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 4,
            "flag" => "e",
            "content"=> "申請経路は繁華街であるため、人通りの多い時間帯の通行は避け、通行時は徐行すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 4,
            "flag" => "f",
            "content"=> "申請経路は商店街のため、人通りの多い時間帯の通行は避け、通行時は徐行すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 5,
            "flag" => "a",
            "content"=> "ガードレールを外して走行する際は、企画管理課占用係と協議すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 5,
            "flag" => "b",
            "content"=> "ポールなどの撤去が必要な場合は事前に企画管理課占用係と協議すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 5,
            "flag" => "c",
            "content"=> "歩道を通行する際は企画管理課占用係と協議すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 5,
            "flag" => "d",
            "content"=> "道路および歩道を占用して工事を行う場合は、企画管理課占用係と協議し、所管の警察署の許可を得、その指示に従うこと。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 5,
            "flag" => "e",
            "content"=> "キャタピラ走行する際には企画管理課占用係と協議すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 5,
            "flag" => "f",
            "content"=> "積載機械自走については、企画管理課占用係と協議すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 5,
            "flag" => "g",
            "content"=> "事前提出済み誓約書記載事項を遵守すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 5,
            "flag" => "h",
            "content"=> "区有通路（水路）を通過するため、別紙誓約書を遵守すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 6,
            "flag" => "a",
            "content"=> "一方通行逆走については所轄の警察署と協議し、その指導に従うこと。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 6,
            "flag" => "b",
            "content"=> "当該道路の規制等について所轄の警察署の許可を取り、その指導に従うこと。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 7,
            "flag" => "a",
            "content"=> "申請経路は非常に交通量の多い道路であるため、周囲の安全に十分配慮のうえ通行すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 7,
            "flag" => "b",
            "content"=> "申請車両は車高が非常に高いため、上空の安全に十分配慮し、クリアランスの少ない個所では徐行すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 8,
            "flag" => "代特1",
            "content"=> "代特車１号線の曲線部は見通しが悪く、道路中央を超えての走行になるため、誘導車を配置し、周囲の安全に配慮すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 8,
            "flag" => "230",
            "content"=> "特別区道第230号路線には代々幡橋（耐荷重20t）があるため、前後に誘導車を配し、他の車両を排除し、申請書の車両重量を遵守し、連行せず徐行すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 8,
            "flag" => "632",
            "content"=> "道路舗装（インターロッキング）がされており、道路入り口にアーチ、防護柱があるため、道路保護内容や通行について、必ずxx商店会(xx-xxxx-xxxx)と協議すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 8,
            "flag" => "847",
            "sort_order" => 1,
            "content"=> "特別区道第847号路線には地蔵橋があり、当該橋梁を通行する際は次の内容を遵守すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 8,
            "flag" => "847",
            "sort_order" => 2,
            "content"=> "➀徐行すること。➁当該車両以外の車両（自転車を含む）や、歩行者等が通行しない状態で通行すること。➂２台以上の特殊車両が縦列をなして同時に当該橋梁を通行しないこと（連行禁止）。➃誓約書の内容を遵守すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 8,
            "flag" => "850",
            "sort_order" => 1,
            "content"=> "特別区道第850号は水道用地のため、東京都水道局の許可を得、その指示に従うこと。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 8,
            "flag" => "850",
            "sort_order" => 2,
            "content"=> "東京都水道局の「水道用地の通行承認について」、及び渋谷区「誓約書」を遵守すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 8,
            "flag" => "979",
            "content"=> "特別区道第979号路線はインターロッキングが敷設されているため、路面保護措置をとったうえで、その内容について事前に株式会社xxxxxと協議すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 8,
            "flag" => "1039",
            "sort_order" => 1,
            "content"=> "xx電鉄㈱の「道路侵入条件解除回答書」及び渋谷区「誓約書」を遵守すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 8,
            "flag" => "1039",
            "sort_order" => 2,
            "content" => "xx㈱の「クレーン作業許可確認書」及び渋谷区「誓約書」を遵守すること。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 10,
            "flag" => "0",
            "content" => "申請経路上の折進部分に狭小箇所あり",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 10,
            "flag" => "0",
            "content" => "交差点狭小",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 10,
            "flag" => "特8",
            "content" => "特車8号線、ガード下高さ制限あり（3.9m以下）。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 10,
            "flag" => "特13",
            "content" => "特車13号線に恵比寿南橋（耐荷重20t）が存在する。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 10,
            "flag" => "特15",
            "content" => "特車15号線に参宮橋（耐荷重20t）が存在する。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 10,
            "flag" => "東特3",
            "content" => "東特車3号線には氷川橋（耐荷重9t）が存在する。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 10,
            "flag" => "219",
            "content" => "特別区道第219号路線に常盤橋（耐荷重20t）が存在する。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 10,
            "flag" => "228",
            "content" => "特別区道第228号路線に山下橋（耐荷重20t）が存在する。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 10,
            "flag" => "230",
            "content" => "特別区道第230号路線に代々幡橋（耐荷重20t）が存在する。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 10,
            "flag" => "561",
            "content" => "特別区道第561号路線に比丘橋（耐荷重20t）が存在する。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 10,
            "flag" => "611",
            "content" => "特別区道第611号路線は狭小。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 11,
            "flag" => "0",
            "content" => "申請車両は重量超過のため。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 11,
            "flag" => "0",
            "content" => "申請車両では折進困難であるため。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 11,
            "flag" => "0",
            "content" => "申請車両では折進不可。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 11,
            "flag" => "0",
            "content" => "申請車両では曲線部通行不可のため。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 11,
            "flag" => "0",
            "content" => "申請車両では高さ制限値を超えるため。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 11,
            "flag" => "0",
            "content" => "申請車両では当該道路の安全な走行が困難であるため。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 11,
            "flag" => "1申請者",
            "content" => "申請者と協議の結果、再申請いただくこととなったため。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 11,
            "flag" => "1申請者",
            "content" => "申請者より経路変更の申出があったため。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 11,
            "flag" => "0",
            "content" => "道路現況について申請者と協議した結果、再検討する旨の申出があったため。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 11,
            "flag" => "0",
            "content" => "申請者より申請車両での折進可能な軌跡図の作成は困難との回答があったため。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 11,
            "flag" => "神特1",
            "content" => "申請車両はxx小学校下交差点の通過が困難であるため。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 11,
            "flag" => "553",
            "content" => "特別区道第553号路線の実走行可能道路幅員の最小が250㎝のため。",
        ];
        DB::table("conditions")->insert($param);

        $param = [
            "conditioncategory_id" => 11,
            "flag" => "993",
            "content" => "申請車両では特別区道第993号路線の折進が困難であるため。",
        ];
        DB::table("conditions")->insert($param);


    }
}
