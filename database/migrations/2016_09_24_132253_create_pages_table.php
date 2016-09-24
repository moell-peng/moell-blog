<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200)->default('')->comment('页面标题');
            $table->string('link_alias', 100)->nullable()->comment('链接别名');
            $table->string('keyword')->default('')->comment('keywords');
            $table->string('desc')->default('')->comment('描述');
            $table->longText('content')->nullable()->comment('页面markdown格式');
            $table->longText('html_content')->nullable()->comment('页面html');
            $table->timestamps();
            $table->unique('link_alias');
            $table->index('link_alias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages');
    }
}
