<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Route;

class RouteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $groups = [
            ['id' => 1, 'prefix' => '恵特車', 'short' => '恵特', 'max' => 10],
            ['id' => 1, 'prefix' => '渋特車', 'short' => '渋特', 'max' => 4],
            ['id' => 1, 'prefix' => '神特車', 'short' => '神特', 'max' => 3],
            ['id' => 1, 'prefix' => '代特車', 'short' => '代特', 'max' => 4],
            ['id' => 1, 'prefix' => '東特車', 'short' => '東特', 'max' => 4], ];

        foreach($groups as $group) {
            for ($i = 1; $i <= $group['max']; $i++) {
                Route::create([
                    'routecategory_id' => $group['id'],
                    'name' => "{$group['prefix']}{$i}号線",
                    'short_name' => $group['short'],
                    'short_number' => $i
                ]);
            }
        }

        for ($i = 1; $i <= 18; $i++) {
            Route::create([
                'routecategory_id' => 2,
                "name" => "特車{$i}号線",
                "short_name" => "特",
                "short_number" => $i,
            ]);
        }

        for ($i = 1; $i <= 299; $i++) {
            Route::create([
                'routecategory_id' => 3,
                "name" => "特別区道第{$i}号路線",
                "short_number" => $i,
            ]);
        }

        for ($i = 300; $i <= 599; $i++) {
            Route::create([
                'routecategory_id' => 4,
                "name" => "特別区道第{$i}号路線",
                "short_number" => "{$i}",
            ]);
        }

        for ($i = 600; $i <= 899; $i++) {
            Route::create([
                'routecategory_id' => 5,
                "name" => "特別区道第{$i}号路線",
                "short_number" => $i,
            ]);
        }

        for ($i = 900; $i <= 1100; $i++) {
            Route::create([
                'routecategory_id' => 6,
                "name" => "特別区道第{$i}号路線",
                "short_number" => $i,
            ]);
        }

        for ($i = 1; $i <= 5; $i++) {
            Route::create([
                'routecategory_id' => 7,
                "name" => "【経路{$i}】",
            ]);
        }

        $route = Route::where('routecategory_id', 3)
            ->where('short_number', 5)
            ->update([
                'remarks' => '本村橋（耐荷重14t）',
            ]);

        $route = Route::where('routecategory_id', 3)
            ->where('short_number', 190)
            ->update([
                'remarks' => '代右衛門橋（耐荷重20t）',
            ]);

        $route = Route::where('routecategory_id', 3)
            ->where('short_number', 219)
            ->update([
                'remarks' => '常盤橋（耐荷重20t）',
            ]);
        $route = Route::where('routecategory_id', 3)
            ->where('short_number', 228)
            ->update([
                'remarks' => '山下橋（耐荷重20t）',
            ]);
        $route = Route::where('routecategory_id', 3)
            ->where('short_number', 230)
            ->update([
                'remarks' => '代々幡橋（耐荷重20t）',
            ]);
        $route = Route::where('routecategory_id', 4)
            ->where('short_number', 494)
            ->update([
                'remarks' => '新豊澤橋（耐荷重9t）',
            ]);
        $route = Route::where('routecategory_id', 4)
            ->where('short_number', 547)
            ->update([
                'remarks' => '氷川橋（耐荷重9t）',
            ]);
        $route = Route::where('routecategory_id', 4)
            ->where('short_number', 561)
            ->update([
                'remarks' => '比丘橋（耐荷重20t）',
            ]);
        $route = Route::where('routecategory_id', 5)
            ->where('short_number', 606)
            ->update([
                'remarks' => '旧渋谷川遊歩道（耐荷重14t）',
            ]);
        $route = Route::where('routecategory_id', 5)
            ->where('short_number', 847)
            ->update([
                'remarks' => '地蔵橋（耐荷重14t）',
            ]);
        $route = Route::where('routecategory_id', 5)
            ->where('short_number', 894)
            ->update([
                'remarks' => '八幡橋（耐荷重20t）',
            ]);
        $route = Route::where('routecategory_id', 5)
            ->where('short_number', 898)
            ->update([
                'remarks' => 'なかよし橋（耐荷重9t）',
            ]);
        $route = Route::where('routecategory_id', 6)
            ->where('short_number', 900)
            ->update([
                'remarks' => 'なかよし橋（耐荷重9t）',
            ]);
        $route = Route::where('routecategory_id', 1)
            ->where('short_name', "代特")
            ->where('short_number', 3)
            ->update([
                'remarks' => '水道局許可',
            ]);
        $route = Route::where('routecategory_id', 1)
            ->where('short_name', "東特")
            ->where('short_number', 3)
            ->update([
                'remarks' => '氷川橋（耐荷重9t）',
            ]);
        $route = Route::where('routecategory_id', 2)
            ->where('short_number', 5)
            ->update([
                'remarks' => '橋梁（耐荷重20t）',
            ]);
        $route = Route::where('routecategory_id', 2)
            ->where('short_number', 13)
            ->update([
                'remarks' => '恵比寿南橋（耐荷重20t）',
            ]);
        $route = Route::where('routecategory_id', 2)
            ->where('short_number', 15)
            ->update([
                'remarks' => '参宮橋（耐荷重20t）',
            ]);
    }
}
