<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_urls', function (Blueprint $table) {
            $table->increments('id')->comment('쇼핑몰 카테고리 URL id');
            $table->unsignedInteger('shop_id')->comment('쇼핑몰 ID');
            $table->string('crawl_url',255)->comment('쇼핑몰 Crawling URL(카테고리 URL)');
            $table->enum('crawl_type',['page','api','excel','pdf','etc'])->comment('Crawling 의 종류');
            $table->unsignedInteger('crawl_page_count')->comment('해당 카테고리의 Crawling 을 수행한 페이지수');
            $table->String('category_origin_name',255)->index()->comment('쇼핑몰에서 명명한 카테고리 이름');
            $table->String('category_borabora_name',255)->index()->comment('BoraBora Platform에서 명명한 카테고리 이름');
            $table->dateTime('created_at')->comment('카테고리 URL 등록일시');
            $table->dateTime('updated_at')->comment('카테고리 URL 변경일시');


            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_urls', function (Blueprint $table) {
            $table->dropForeign(['shop_id']);
        });

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('category_urls');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
