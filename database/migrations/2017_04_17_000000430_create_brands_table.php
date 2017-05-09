<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id')->comment('브랜드 id');
            $table->string('brand_name')->index()->comment('브랜드명');
            $table->string('brand_homepage')->nullable()->comment('브랜드 홈페이지');
            $table->string('brand_country')->nullable()->comment('브랜드 국적');
            $table->dateTime('created_at')->comment('쇼핑몰/부띠끄 정보 등록일시');
            $table->dateTime('updated_at')->comment('쇼핑몰/부띠끄 정보 변경일시');
            $table->dateTime('deleted_at')->nullable()->comment('Software Delete 일시');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('brands');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
