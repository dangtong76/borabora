<?php

/*
 * 테이블명 : TRASH_PRODUCTS
 * 사용목적 : Porduct 테이블의 상품을 관리자가 삭제시 Trash Products 테이블에 적제하고 Product 테이블의 상품을 삭제
 *           Trash Products 테이블에서 복원시 Product 테이블로 상품을 복원하되 Product Table 의 id 값은 Auto
 *           Increment 이기 때문에 새로운 Product.id 값을 부여하게됨.
 * 작성자   : 변현창
 * 작성일   : 2017년 4월 18일
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;



class CreateTrashProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trash_products', function (Blueprint $table) {

            // Primary Key
            $table->increments('id')->comment('Trash_Products 테이블의 상품ID');

            // 참조키
            $table->unsignedInteger('shop_id')->index()->comment('쇼핑몰 ID');
            $table->unsignedInteger('shop_category_url_id')->index()->comment('해당 쇼핑몰 카테고리 URL ID');
            $table->unsignedInteger('brand_id')->index()->comment('브랜드 ID');

            // 제품 정보
            $table->unsignedInteger('product_id')->comment('Products 테이블의 상품 ID');
            $table->string('sku_id',100)->index()->comment('쇼핑몰 제품 ID, 값이 없으면 products.id 와 동일값');
            $table->string('name',255)->index()->comment('상품명');
            $table->string('color',255)->nullable()->comment('제품 색상');
            $table->tinyInteger('delivery_type')->nullable()->comment('배송구분'); //삭제 고려
            $table->string('short_DESC',255)->nullable()->comment('짧은 제품 설명');
            $table->mediumText('long_DESC')->nullable()->comment('상세 제품 설명');
            $table->date('launch_date')->nullable()->comment('제품 출시일 이며 없을경우 최초 Crawl 일자');
            $table->enum('option_type',['single','double'])->default('single')->comment('옵션의 종류');
            $table->string('option_name',30)->comment('옵션의 이름');
            $table->text('option')->comment('옵션내용');

            // 가격관련 컬럼
            $table->string('event_price',50)->nullable()->comment('크롤링 대상 쇼핑몰의 대표 할인가격');
            $table->string('before_event_price',50)->nullable()->comment('크롤링 대상 쇼핑몰의 변경전 대표 할인가격');
            $table->string('price',50)->comment('크롤링 대상 쇼핑몰의 대표 가격');
            $table->string('before_price',50)->comment('크롤링 대상 쇼핑몰의 변경전 대표 가격');
            $table->tinyInteger('is_taxation')->comment('과세/비과세 여부 1:과세, 0:비과세'); //삭제 고려

            //부가정보
            $table->string('memo',255)->nullable()->comment('관리자의 상품에 대한 메모');
            $table->string('extra_title',255)->nullable()->comment('상품에 대한 부가설명 제목');
            $table->string('extra_1',255)->nullable()->comment('부가설명1');
            $table->string('extra_2',255)->nullable()->comment('부가설명2');

            // 상품 이미지 관련 정보
            $table->integer('img_count')->comment('이미지 개수');
            $table->text('img_urls')->comment('이미지 URL 경로 "|" 로 구분');

            // 크롤링 관련 정보
            $table->tinyInteger('crawl_active')->index()->comment('크롤링 수집 할성화 여부 1:활성 0:비활성');
            $table->dateTime('crawl_last_time')->comment('마지막 수집 일시');
            $table->enum('crawl_last_status',['success','fail','unknown'])->index()->comment('최종 수집 결과');
            $table->string('crawl_last_error',255)->index()->nullable()->comment('마지막 수집시 발생한 에러');
            $table->text('crawl_url')->comment('상품 Crawling URL');

            // 값 비교용 Hash값
            $table->string('hash_img')->index()->comment('이미지 해싱 정보');
            $table->string('hash_price')->index()->comment('가격 해싱 정보');
            $table->string('hash_stock')->index()->comment('옵션 해싱 정보');

            // 데이타 생성 및 수정 시간 정보
            $table->dateTime('created_at')->index()->comment('상품 등록일시');
            $table->dateTime('updated_at')->index()->comment('상품 정보 변경일시');


            // Foreign Key 관계정보
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->foreign('shop_category_url_id')->references('id')->on('category_urls')->onDelete('cascade');
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

        Schema::table('trash_products', function (Blueprint $table) {
            $table->dropForeign(['shop_id']);
            $table->dropForeign(['shop_category_url_id']);
            $table->dropForeign(['brand_id']);
        });

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::dropIfExists('trash_products');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
