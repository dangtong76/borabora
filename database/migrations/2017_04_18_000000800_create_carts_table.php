<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {

            // Primary Key
            $table->increments('id')->comment('Carts 테이블의 ID');

            // Foreign Key
            $table->unsignedInteger('product_id')->unique()->index()->comment('BoraBora 의 상품ID');
            $table->unsignedInteger('member_id')->index()->comment('User 테이블의 ID');

            //연동정보 등록 및 변경 일시
            $table->dateTime('created_at')->index()->comment('최초 연동일자');
            $table->dateTime('updated_at')->index()->comment('연동 정보 변경일자');

            // Foreign Key 관계정보
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
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
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['member_id']);
        });

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::dropIfExists('carts');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
