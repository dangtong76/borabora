<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targets', function (Blueprint $table) {

            // Primary Key
            $table->increments('id')->comment('Targets 테이블의 ID');

            // Foreign Key
            $table->unsignedInteger('product_id')->index()->comment('BoraBora 의 상품ID');

            // 연동정보
            $table->string('target_name')->index()->comment('타겟 쇼핑몰 이름');
            $table->enum('target_type',['api','db'])->comment('타겟 쇼핑몰 연동방식 [api,db]');
            $table->string('target_db_env_prefix')->nullable()->comment('DB연동 방식일 경우 .env파일의 식별자');
            $table->string('target_api_url',500)->nullable()->comment('API연동 방식일 경우 대표 URL');

            //연동 쇼핑몰의 상품 상태정보
            $table->unsignedInteger('target_product_id')->nullable()->index()->comment('타겟 쇼핑몰의 상품ID ');
            $table->tinyInteger('is_opened')->nullable()->comment('타겟 쇼핑몰 진열여부 1:진열 0:미진열');

            //연동정보 등록 및 변경 일시
            $table->dateTime('created_at')->index()->comment('최초 연동일자');
            $table->dateTime('updated_at')->index()->comment('연동 정보 변경일자');

            // Foreign Key 관계정보
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Migration RollBack 시 수행 Action 정의
        Schema::table('targets', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::dropIfExists('targets');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
