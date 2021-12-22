<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            array('id' => '1','name' => 'Administrator','email' => 'admin@gmail.com','phone' => '087112334556','identity_card' => '3256167898763456','email_verified_at' => NULL,'password' => '$2y$10$iZNEEUmfsjorjQrLyesJ9.9Ei/NXMHtLsP7/GwztwYLZUjRnAY2rK','avatar' => '5fdcea2fab2e6.png','role' => 'admin','remember_token' => NULL,'created_at' => '2020-12-18 17:29:30','updated_at' => '2020-12-18 17:43:11'),
            array('id' => '2','name' => 'Pevita Pearce','email' => 'pevita@gmail.com','phone' => '089765467889','identity_card' => '0987623455678909','email_verified_at' => NULL,'password' => '$2y$10$8UVjeKzad.4dXvIPNU3I9uNb0DiH0qtwXMkLEPQLCxxA9fDWXGyHG','avatar' => NULL,'role' => 'member','remember_token' => NULL,'created_at' => '2020-12-19 12:00:49','updated_at' => '2020-12-19 12:00:49')
        );

        DB::table('users')->insert($users);
    }
}
