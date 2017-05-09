<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {

            //primary Key
            $table->increments('id')->comment('쇼핑몰/부띠끄 ID');

            $table->string('name', 150)->index()->comment('쇼핑몰/부띠끄 이름');
            $table->string('homepage')->nullable()->comment('쇼핑몰/부띠끄 사이트 주소');
            $table->string('shop_country')->nullable()->comment('쇼핑몰/부띠크 국가');
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
        Schema::dropIfExists('shops');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
