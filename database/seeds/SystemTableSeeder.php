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
            ['key' => 'blog_name'],
            ['key' => 'motto'],
            ['key' => 'title'],
            ['key' => 'seo_keyword'],
            ['key' => 'seo_desc'],
            ['key' => 'icp'],
            ['key' => 'github_url'],
            ['key' => 'weibo_url']
        ];
        DB::table('systems')->insert($systems);
    }
}
