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
    }
}
