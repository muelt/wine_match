<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ここから追加
        DB::table('users')->insert([
            ['name' => 'taro',
            'email' => 'taro@gmail.com',
            'sex' => '0',
            'self_introduction' => 'taroです',
            'image' => 'taro.jpeg',
            'password' => Hash::make('11111111'),
            'age' => '30',
            'address' => '渋谷区', 
            'type_of_wine' => '白ワイン', 
            'verify_of_wine' => 'シャルドネ',
            'producing_area' => 'ブルゴーニュ',
            'favorite_food' => 'フレンチ',
            'price_range' => '~15,000円',
            'favorite_restaurant' => '',
            ],

            ['name' => 'hanako',
            'email' => 'hanako@gmail.com',
            'sex' => '1',
            'self_introduction' => 'hanakoです',
            'image' => 'hanako.jpeg',
            'password' => Hash::make('11111111'),
            'age' => '50',
            'address' => '江東区', 
            'type_of_wine' => '赤ワイン', 
            'verify_of_wine' => 'シラー',
            'producing_area' => 'オーストラリア',
            'favorite_food' => 'ジビエ',
            'price_range' => '~10,000円',
            'favorite_restaurant' => '',
            ],
        ]);
    }
}
