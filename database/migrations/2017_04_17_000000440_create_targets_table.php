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

            // 연동정보
            $table->string('name')->index()->comment('타겟 쇼핑몰 이름');
            $table->enum('type',['api','db'])->comment('타겟 쇼핑몰 연동방식 [api,db]');
            $table->string('target_db_env_prefix')->nullable()->comment('DB연동 방식일 경우 .env파일의 식별자');
            $table->string('target_api_url',500)->nullable()->comment('API연동 방식일 경우 대표 URL');

            //연동정보 등록 및 변경 일시
            $table->dateTime('created_at')->index()->comment('최초 연동일자');
            $table->dateTime('updated_at')->index()->comment('연동 정보 변경일자');

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
        Schema::dropIfExists('targets');
    }
}
