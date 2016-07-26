<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200)->default('')->comment('文章标题');
            $table->longText('content')->defualt('')->comment('文章内容');
            $table->integer('user_id')->default(0)->comment('文章编写人,对应users表');
            $table->integer('cate_id')->defualt(0)->comment('文章分类');
            $table->integer('comment_count')->default(0)->comment('评论数量');
            $table->integer('read_count')->default(0)->comment('阅读数量');
            $table->tinyInteger('status')->default(0)->comment('文章状态：0-公开;1-私密');
            $table->integer('desc')->defualt(0)->comment('排序');
            $table->timestamps();
            $table->index('cate_id');
            $table->index('user_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article');
    }
}
