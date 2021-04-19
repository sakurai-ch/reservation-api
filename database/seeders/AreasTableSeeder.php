<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'area_id' => 1,
            'area_name' => '東京都'
        ];
        Area::insert($param);
        
        $param = [
            'area_id' => 2,
            'area_name' => '大阪府'
        ];
        Area::insert($param);

        $param = [
            'area_id' => 3,
            'area_name' => '福岡県'
        ];
        Area::insert($param);

    }
}
