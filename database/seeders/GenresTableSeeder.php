<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenresTableSeeder extends Seeder
{
    public function run()
    {
        $param = [
            'id' => 1,
            'genre_name' => '寿司'
        ];
        Genre::insert($param);
        
        $param = [
            'id' => 2,
            'genre_name' => '焼肉'
        ];
        Genre::insert($param);

        $param = [
            'id' => 3,
            'genre_name' => '居酒屋'
        ];
        Genre::insert($param);
        
        $param = [
            'id' => 4,
            'genre_name' => 'イタリアン'
        ];
        Genre::insert($param);

        $param = [
            'id' => 5,
            'genre_name' => 'ラーメン'
        ];
        Genre::insert($param);

    }
}
