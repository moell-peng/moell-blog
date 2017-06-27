<?php

use Illuminate\Database\Seeder;

class SystemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $systems = [
            ['key' => 'blog_name', 'value' => 'Moell Blog'],
            ['key' => 'motto', '欢迎使用Moell Blog,欢迎Star。']
        ];
        DB::table('systems')->insert($systems);
    }
}
