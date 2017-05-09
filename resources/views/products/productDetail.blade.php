@extends('layouts.app')
@section('style')
    <style>
        .panel {
            padding-top: 0;
            padding-bottom: 0;
        }

        .panel-heading {
            margin-top: 0;
            margin-bottom: 0;
            padding-top: 0;
            padding-bottom: 0;
        }

        .panel-body {
            margin-top: 0;
            margin-bottom: 0;
            padding-top: 0;
            padding-bottom: 0;
        }

        table.table tr th {
            background-color: #edeff2 !important;
            font-color: white !important;
        }
    </style>
@endsection
@section('content')
    <div class="panel">
        <div class="panel-body">
            <h3>
                <small><p class="text-info"><i class="fa fa-shopping-bag"></i>&nbsp&nbsp상품 상세정보</p></small>
            </h3>
        </div>
    </div>
    <div class="panel">
        <div class="panel-heading"></div>
        <div class="panel-body">
            <div class="table-responsive">
                <h4><i class="fa fa-arrow-circle-right"></i> 상품정보</h4>
                <table class="table table-bordered table-hover table-condensed table-condensed background-color: black">
                    <tr>
                        <th class="col-lg-1 col-md-1">상품ID</th>
                        <td class="col-lg-1 col-md-1">{{ $product->id }}</td>
                        <th class="col-lg-1 col-md-1">상품명</th>
                        <td class="col-lg-1 col-md-1">{{ $product->name }}</td>
                        <th class="col-lg-1 col-md-1">제고</th>
                        <td class="col-lg-1 col-md-1">{{ $product->stock_max }}</td>
                    </tr>
                    <tr>
                        <th class="col-lg-1 col-md-1">쇼핑몰 SKU</th>
                        <td class="col-lg-1 col-md-1">{{ $product->sku_id }}</td>
                        <th class="col-lg-1 col-md-1">원산지</th>
                        <td class="col-lg-1 col-md-1">{{ $product->origin }}</td>
                        <th class="col-lg-1 col-md-1">과세여부</th>
                        <td class="col-lg-1 col-md-1">{{ ($product->is_taxation == '1') ? '과세대상' : '비과세 '}}</td>
                    </tr>
                    <tr>
                        <th class="col-lg-1 col-md-1">가격</th>
                        <td class="col-lg-1 col-md-1">{{ $product->price }}</td>
                        <th class="col-lg-1 col-md-1">이전가격</th>
                        <td class="col-lg-1 col-md-1">{{ $product->before_price }}</td>
                        <th class="col-lg-1 col-md-1">최근 가격 변경일</th>
                        <td class="col-lg-1 col-md-1">{{ $product->price_updated_at }}</td>
                    </tr>
                    <tr>
                        <th class="col-lg-1 col-md-1">이벤트 가격</th>
                        <td class="col-lg-1 col-md-1">{{ $product->event_price }}</td>
                        <th class="col-lg-1 col-md-1">이전 이벤트 가격</th>
                        <td class="col-lg-1 col-md-1">{{ $product->before_event_price }}</td>
                        <th class="col-lg-1 col-md-1">최근 이벤트 가격 변경일</th>
                        <td class="col-lg-1 col-md-1">{{ $product->event_price_updated_at }}</td>
                    </tr>
                    <tr>
                        <th class="col-lg-1 col-md-1">배송타입</th>
                        <td class="col-lg-1 col-md-1">{{ $product->delivery_type }}</td>
                        <th class="col-lg-1 col-md-1">최조 등록일</th>
                        <td class="col-lg-1 col-md-1">{{ $product->created_at }}</td>
                        <th class="col-lg-1 col-md-1">최근 변경일 (최근수집시간)</th>
                        <td class="col-lg-1 col-md-1">{{ $product->updated_at }}</td>
                    </tr>
                    <tr>
                        <th class="col-lg-1 col-md-1">상품 설명</th>
                        <td colspan="5"> {{ $product->short_DESC }} </td>
                    </tr>
                    <tr>
                        <th class="col-lg-1 col-md-1">상품 상세설명</th>
                        <td colspan="5"> {{ $product->long_DESC }} </td>
                    </tr>
                    <tr>
                        <th class="col-lg-1 col-md-1">상품 이미지</th>
                        <td colspan="5"></td>
                    </tr>
                </table>
            </div>

            <div class="table-responsive">
                <h4><i class="fa fa-arrow-circle-right"></i> 수집정보</h4>
                <table class="table table-bordered table-hover table-condensed table-condensed background-color: black">
                    <tr>
                        <th class="col-lg-1 col-md-1">수집 쇼핑몰</th>
                        <td class="col-lg-1 col-md-1">{{ isset($product->shop->name) ? $product->shop->name : null }}</td>
                        <th class="col-lg-1 col-md-1">쇼핑몰 국적</th>
                        <td class="col-lg-1 col-md-1">{{ isset($product->shop->shop_country) ? $product->shop->shop_country : null }}</td>
                        <th class="col-lg-1 col-md-1">쇼핑몰 등록익</th>
                        <td class="col-lg-1 col-md-1">{{ isset($product->shop->created_at) ? $product->shop->created_at : null }}</td>
                    </tr>
                    <tr>
                        <th class="col-lg-1 col-md-1">수집 활성화</th>
                        <td class="col-lg-1 col-md-1">
                            @if($product->crawl_active == '1')
                                <button type="button" class="btn btn-xs btn-success">Enabled</button>
                            @elseif($product->crawl_active == '0')
                                <button type="button" class="btn btn-xs btn-warn">Disabled</button>
                            @endif
                        </td>
                        <th class="col-lg-1 col-md-1">쇼핑몰 국적</th>
                        <td class="col-lg-1 col-md-1">{{ isset($product->shop->shop_country) ? $product->shop->shop_country : null }}</td>
                        <th class="col-lg-1 col-md-1">쇼핑몰 등록익</th>
                        <td class="col-lg-1 col-md-1">{{ isset($product->shop->created_at) ? $product->shop->created_at : null }}</td>
                    </tr>
                    <tr>
                        <th class="col-lg-1 col-md-1">수집 URL</th>
                        <td colspan="5"><a href="{{ $product->crawl_url }}">{{ $product->crawl_url }}</a></td>
                    </tr>
                </table>
            </div>

            <div class="table-responsive">
                <h4><i class="fa fa-arrow-circle-right"></i> 타겟정보</h4>
                <table class="table table-bordered table-hover table-condensed table-condensed background-color: black">
                    <tr>
                        <th class="col-lg-1 col-md-1">타겟 쇼핑몰</th>
                        <td class="col-lg-1 col-md-1">{{ isset($product->target->name) ? $product->target->name : null }}</td>
                        <th class="col-lg-1 col-md-1">상품 ID</th>
                        <td class="col-lg-1 col-md-1">{{ isset($product->target_product_id) ? $product->target_product_id : null }}</td>
                        <th class="col-lg-1 col-md-1">진열 여부</th>
                        <td class="col-lg-1 col-md-1">{{ $product->is_opened }}</td>
                    </tr>
                    <tr>
                        <th class="col-lg-1 col-md-1">수집 URL</th>
                        <td colspan="5"><a href="{{ $product->crawl_url }}">{{ $product->crawl_url }}</a></td>
                    </tr>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-hovertable-condensed background-color: black">
                    <tr>
                        <td colspan="6">
                            <div class="form-group">
                                <a href="{{ url()->previous() }}">
                                <button type="submit" class="btn-block btn-basic"> <h4><bold><i class="fa fa-backward"></i>   BACK</bold></h4>
                                </button>
                                </a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection

