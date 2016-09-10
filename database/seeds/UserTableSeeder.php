<?php

use DB;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'  => 'admin',
            'email' => 'admin@gmall.com',
            'password' => bcrypt('admin')
        ]);
    }
}
