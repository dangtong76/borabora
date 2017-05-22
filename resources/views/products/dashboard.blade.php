@extends('layouts.menu')
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

        .btn-primary {
            width: 78px !important;
        }


    </style>
@endsection

@section('content')
    <div class="panel">
        <div class="panel-body">
            <h3>
                <small><p class="text-info"><i class="fa fa-shopping-bag"></i>&nbsp&nbsp상품관리</p></small>
            </h3>
        </div>
    </div>
    <div class="panel">
        <div class="panel-heading"></div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table  table-striped background-color: black">
                    {!! Form::open(['route' => 'products.index', 'method' => 'get','class' =>'form']) !!}
                    <tr class="col-md-9 col-lg-9">
                        <td class="col-md-1 col-lg-2">
                            <div class="form-group">
                                <h4>
                                    <small><i class="fa fa-chevron-circle-down"></i>&nbsp&nbsp재고 구분</small>
                                </h4>
                                <label class="radio-inline">
                                    {!! Form::radio('stock', '2', (Input::old('stock') == '2') ? true : true, array('id'=>'stockALL', 'class'=>'radio')) !!}
                                    ALL
                                </label>
                                <label class="radio-inline">
                                    {!! Form::radio('stock', '1', (Input::old('stock') == '1'), array('id'=>'stockExist', 'class'=>'radio')) !!}
                                    재고<strong>유</strong>
                                </label>

                                <label class="radio-inline">
                                    {!! Form::radio('stock', '0', (Input::old('stock') == '0'), array('id'=>'stcokNo', 'class'=>'radio')) !!}
                                    재고<strong>무</strong>
                                </label>
                            </div>
                        </td>

                        <td class="col-md-1 col-lg-2">
                            <div class="form-group">
                                <h4>
                                    <small><i class="fa fa-chevron-circle-down"></i>&nbsp&nbsp타겟 구분</small>
                                </h4>
                                <label class="radio-inline">
                                    {!! Form::radio('target', '3', (Input::old('target') == '3') ? true : true, array('id'=>'targetAll', 'class'=>'radio')) !!}
                                    ALL
                                </label>
                                <label class="radio-inline">
                                    {!! Form::radio('target', '2', (Input::old('target') == '2'), array('id'=>'targetAdult', 'class'=>'radio')) !!}
                                    키즈
                                </label>
                                <label class="radio-inline">
                                    {!! Form::radio('target', '1', (Input::old('target') == '1'), array('id'=>'targetKid', 'class'=>'radio')) !!}
                                    성인
                                </label>
                                <label class="radio-inline">
                                    {!! Form::radio('target', '0', (Input::old('target') == '0'), array('id'=>'targetNo', 'class'=>'radio')) !!}
                                    미연결
                                </label>
                            </div>
                        </td>
                        <td class="col-md-1 col-lg-1">
                            <div class="form-group">
                                <select name=shop class="form-control input-sm">
                                    <option value="">수집소스 선택</option>
                                    @foreach ($shops as $shop)
                                        <option value="{{ $shop->id }}" {{ old('shop') == $shop ->id ? 'selected' : '' }}>
                                            {{ $shop->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td class="col-md-1 col-lg-1">
                            <div class="form-group">
                                <select name=brand class="form-control input-sm">
                                    <option value="">브랜드 선택</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand') == $brand ->id ? 'selected' : '' }}>
                                            {{ $brand->brand_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td class="col-md-1 col-lg-1">
                            <div class="form-group">
                                <select name="shopurl" class="form-control input-sm">
                                    <option value="">수집소스 선택</option>
                                    @foreach ($shopurls as $shopurl)
                                        <option value="{{ $shopurl->id }}" {{ old('shopurl') == $shopurl->id ? 'selected' : '' }}>
                                            {{ $shopurl->category_borabora_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td class="col-md-1 col-lg-1">
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-primary">검 색
                                </button>
                            </div>
                        </td>
                    </tr>
                    {!! Form::close() !!}
                </table>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-heading"></div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-condensed table-condensed background-color: black">
                    <thead>
                    <tr>
                        <th class="text-center" scope="row">
                            <input type="checkbox" name="chkall" id="chkall"/>
                        </th>
                        <th class="text-left"><i class="fa fa-sort"></i> 고유번호</th>
                        <th class="text-left"><i class="fa fa-sort"></i> 발란코드</th>
                        <th class="text-left"><i class="fa fa-sort"></i> 키즈코드</th>
                        <th class="text-left"><i class="fa fa-sort"></i> 수집업체</th>
                        <th class="text-left"><i class="fa fa-sort"></i> 브랜드명</th>
                        <th class="text-left"><i class="fa fa-sort"></i> 상품이름</th>
                        <th class="text-left"><i class="fa fa-sort"></i> 제고</th>
                        <th class="text-left"><i class="fa fa-sort"></i> 최종수집일</th>
                        <th class="text-left"><i class="fa fa-sort"></i> 등록일자</th>
                        <th class="text-center">수집하기</th>
                        <th class="text-center">수집주소</th>
                        <th class="text-center">송출여부</th>
                        <th class="text-center">상세보기</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th class="text-center" scope="row">
                                <input type="checkbox" name="chk[]" class="list-chkbox" value="#">
                            </th>
                            <td>{{ $product->id }}</td>
                            <td>{{ isset($product->target->name) ? $product->target->name : null}}</td>
                            <td>{{ isset($product->target_product_id) ? $product->target_product_id : null }}</td>
                            <td>{{ $product->shop->name }}</td>
                            <td>{{ $product->brand->brand_name }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ isset($product->stock_max) ? $product->stock_max: '0' }}</td>
                            <td>{{ $product->crawl_last_time }}</td>
                            <td>{{ $product->created_at }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-xs btn-default"><i
                                            class="fa fa-hand-lizard-o"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-xs btn-default"><i
                                            class="fa fa-file-text-o"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                @if(isset($product->target->name) && $product->target->name == 'adult')
                                    <button type="button" class="btn btn-xs btn-info">ADT</button>
                                @elseif(isset($product->target->name) && $product->target->name == 'kid')
                                    <button type="button" class="btn btn-xs btn-warning">KID</button>
                                @else
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('products.show', $product->id) }}"><i
                                            class="fa fa-align-left"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="btn-group">
                    <button type="button" class="btn btn-info"><i class="fa fa-cart-arrow-down"></i> Add To Cart
                    </button>
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">송출</a></li>
                        <li><a href="#">삭제</a></li>
                        <li><a href="#">가격재전송</a></li>
                    </ul>
                </div>

                <div class="text-center">
                    {!! $products->appends(Input::except('page'))->links() !!}
                </div>
                <div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>검색 결과가 없습니다.</strong> 검색을 위해 적정한 값을 선택해 주세요.
                </div>
            </div>
        </div>
    </div>
@endsection


