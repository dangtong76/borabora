<?php

/*
 * 테이블명 : PRODUCTS
 * 사용목적 : BoraBora 시스템의 상품 테이블
 * 작성자   : 변현창
 * 작성일   : 2017년 4월 18일
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            // Primary Key
            $table->increments('id')->comment('Trash_Products 테이블의 상품ID');

            // 참조키
            $table->unsignedInteger('shop_id')->index()->comment('쇼핑몰 ID');
            $table->unsignedInteger('category_url_id')->index()->comment('해당 쇼핑몰 카테고리 URL ID');
            $table->unsignedInteger('brand_id')->index()->comment('브랜드 ID');
            $table->unsignedInteger('target_id')->nullable()->index()->comment('target 정보 연동');

            // 제품 정보
            $table->string('sku_id',100)->index()->comment('쇼핑몰 제품 ID, 값이 없으면 products.id 와 동일값');
            $table->string('name',255)->index()->comment('상품명');
            $table->string('origin',120)->comment('상품국적');
            $table->string('color',255)->nullable()->comment('제품 색상');
            $table->tinyInteger('delivery_type')->nullable()->comment('배송구분'); //삭제 고려
            $table->string('short_DESC',255)->nullable()->comment('짧은 제품 설명');
            $table->mediumText('long_DESC')->nullable()->comment('상세 제품 설명');
            $table->date('launch_date')->nullable()->comment('제품 출시일 이며 없을경우 최초 Crawl 일자');
            $table->integer('stock_max')->comment('option의 제고중 최고값');
            $table->enum('option_type',['single','double'])->default('single')->comment('옵션의 종류');
            $table->string('option_name',30)->comment('옵션의 이름');
            $table->text('option')->comment('옵션내용');

            // 가격관련 컬럼
            $table->string('event_price',50)->nullable()->comment('크롤링 대상 쇼핑몰의 대표 할인가격');
            $table->string('before_event_price',50)->nullable()->comment('크롤링 대상 쇼핑몰의 변경전 대표 할인가격');
            $table->string('price',50)->comment('크롤링 대상 쇼핑몰의 대표 가격');
            $table->string('before_price',50)->nullable()->comment('크롤링 대상 쇼핑몰의 변경전 대표 가격');
            $table->tinyInteger('is_taxation')->nullable()->comment('과세/비과세 여부 1:과세, 0:비과세'); //삭제 고려
            $table->dateTime('price_updated_at')->nullable()->comment('최종 가격이 변경된 일시');
            $table->dateTime('event_price_updated_at')->nullable()->comment('최종 이벤트 가격이 변경되거나 삭제 된 일시');

            //부가정보
            $table->string('memo',255)->nullable()->comment('관리자의 상품에 대한 메모');
            $table->string('extra_title',255)->nullable()->comment('상품에 대한 부가설명 제목');
            $table->string('extra_1',255)->n2ullable()->comment('부가설명1');
            $table->string('extra_2',255)->nullable()->comment('부가설명2');

            // 상품 이미지 관련 정보
            $table->integer('img_count')->comment('이미지 개수');
            $table->text('img_urls')->comment('이미지 URL 경로 "|" 로 구분');

            // 크롤링 관련 정보
            $table->tinyInteger('crawl_active')->index()->comment('크롤링 수집 할성화 여부 1:활성 0:비활성');
            $table->dateTime('crawl_last_time')->comment('마지막 수집 일시');
            $table->enum('crawl_last_status',['success','fail'])->index()->comment('최종 수집 결과');
            $table->string('crawl_last_error',255)->index()->nullable()->comment('마지막 수집시 발생한 에러');
            $table->text('crawl_url')->comment('상품 Crawling URL');

            // 타겟정보
            $table->unsignedInteger('target_product_id')->nullable()->index()->comment('타겟쇼핑몰의상품ID');
            $table->tinyInteger('target_is_opened')->nullable()->comment('타겟쇼핑몰진열여부1:진열0:미진열');
            $table->dateTime('target_created_at')->nullable()->comment('타겟쇼핑몰 최초 진열일시');
            $table->dateTime('target_deleted_at')->nullable()->comment('타겟쇼핑몰 삭제일시');

            // 값 비교용 Hash값
            $table->string('hash_img')->index()->comment('이미지 해싱 정보');
            $table->string('hash_price')->index()->comment('가격 해싱 정보');
            $table->string('hash_option')->index()->comment('옵션 해싱 정보');

            // 데이타 생성 및 수정 시간 정보
            $table->dateTime('created_at')->index()->comment('상품 등록일시');
            $table->dateTime('updated_at')->index()->comment('상품 정보 변경일시');
            $table->dateTime('deleted_at')->nullable()->comment('Software Delete 일시');


            // Foreign Key 관계정보
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->foreign('category_url_id')->references('id')->on('category_urls')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands');
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
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['shop_id']);
            $table->dropForeign(['category_url_id']);
            $table->dropForeign(['brand_id']);
        });

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::dropIfExists('products');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
