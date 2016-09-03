<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('navigations', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name');
			$table->string('url');
			$table->tinyInteger('state')->default(0)->comment('0-正常显示;1-隐藏');
			$table->smallInteger('sequence')->comment('排序');
            $table->tinyInteger('nav_type')->default(0)->comment('导航类型;0-自定义;1-分类导航');
            $table->integer('article_cate_id')->default(0)->comment('文章分类id');
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('navigations');
	}

}
