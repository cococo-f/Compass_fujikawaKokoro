<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        //初期ユーザー作成//
        DB::table('users')->insert([
            ['over_name' => '藤川',
            'under_name' => '真心',
            'over_name_kana' =>'フジカワ',
            'under_name_kana' =>'ココロ',
            'mail_address' => 'omochi@0815.com',
            'sex' =>'2',
            'birth_day' =>'1998/11/30',
            'role' => '4',
            'password' =>bcrypt('password'),],

            ['over_name' => 'キム',
            'under_name' => 'ミンギュ',
            'over_name_kana' =>'キム',
            'under_name_kana' =>'ミンギュ',
            'mail_address' => 'mingyu@0406.com',
            'sex' =>'1',
            'birth_day' =>'1997/04/06',
            'role' => '1',
            'password' =>bcrypt('password'),]
            ]);

    }
}
