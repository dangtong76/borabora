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
                    <tr class="col-md-10 col-lg-10">
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
                            </div>
                        </td>
                        <td class="col-md-1 col-lg-1">
                            <div class="form-group">
                                <select id=shop name=shop class="form-control input-sm">
                                    <option value="0">수집소스 선택</option>
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
                                <select id=brand name=brand class="form-control input-sm">
                                    <option value="" disabled>브랜드 선택</option>
                                    {{--
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand') == $brand ->id ? 'selected' : '' }}>
                                            {{ $brand->brand_name }}
                                        </option>
                                    @endforeach
                                    --}}
                                </select>
                            </div>
                        </td>
                        <td class="col-md-1 col-lg-1">
                            <div class="form-group">
                                <select id=shopurl name=shopurl class="form-control input-sm">
                                    <option value="" disabled>카테고리 선택</option>
                                    {{--
                                    @foreach ($shopurls as $shopurl)
                                        <option value="{{ $shopurl->id }}" {{ old('shopurl') == $shopurl->id ? 'selected' : '' }}>
                                            {{ $shopurl->category_borabora_name }}
                                        </option>
                                    @endforeach
                                    --}}
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
                    {{--
                    <tr class="col-md-9 col-lg-9">
                        <div class='input-group date'>
                            <input type='text' class="form-control" data-provide="datepicker"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </tr>
                    --}}
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
                            <input type="checkbox" name="chkall" id="chkall" class="chkall"/>
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
                    {{ Form::open(array('route' => 'products.action', 'method' => 'post','class' =>'form'))  }}
                    @foreach ($products as $product)
                        <tr>
                            <th class="text-center" scope="row">
                                <input type="checkbox" name="product_check[]" class="list-chkbox"
                                       value="{{$product->id}}">
                            </th>
                            <td>{{ $product->id }}</td>
                            <td>{{ isset($product->target->name) ? $product->target->name : null}}</td>
                            <td>{{ isset($product->target_product_id) ? $product->target_product_id : null }}</td>
                            <td>{{ isset($product->shop->name) ? $product->shop->name : null }}</td>
                            <td>{{ isset($product->brand->brand_name) ? $product->brand->brand_name : null }}</td>
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


                <button type="submit" class="btn btn-success" value="1"><i class="glyphicon glyphicon-send"></i> 송출
                </button>
                <button type="submit" class="btn btn-warning"><i class="glyphicon glyphicon-usd"></i> 가격재전송
                </button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> 삭제
                </button>


                {!! Form::close() !!}
                <div class="text-center">
                    {!! $products->appends(Input::except('page'))->links() !!}
                </div>


                <div id="productModal_fail" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">에러 발생</h4>
                            </div>
                            <div class="modal-body">
                                <p>이미 송출한 상품 입니다.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>

                <div id="productModal_success" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">송출 성공</h4>
                            </div>
                            <div class="modal-body">
                                <p>상품송출을 완료 하였습니다.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $('#shop').change(function () {

            $.get('/shops/' + this.value + '/brand.json', function (brands) {
                var $brand = $('#brand');

                $brand.find('option').remove().end();

                if (brand.id == "{{ old('brand') }}")
                    $brand.append('<option value=""> 브랜드 선택</option>');
                else
                    $brand.append('<option value="" selected> 브랜드 선택</option>');


                $.each(brands, function (index, brand) {
                    if (brand.id == "{{ old('brand') }}")
                        $brand.append('<option value="' + brand.id + '" selected>' + brand.brand_name + '</option>');
                    else
                        $brand.append('<option value="' + brand.id + '">' + brand.brand_name + '</option>');

                });
            });


            $.get('/shops/' + this.value + '/category.json', function (shopurls) {
                var $shopurl = $('#shopurl');

                $shopurl.find('option').remove().end();

                if (shopurl.id == "{{ old('shopurl') }}")
                    $shopurl.append('<option value=""> 카테고리 선택</option>');
                else
                    $shopurl.append('<option value="" selected> 카테고리 선택</option>');


                $.each(shopurls, function (index, shopurl) {
                    if (shopurl.id == "{{ old('shopurl') }}")
                        $shopurl.append('<option value="' + shopurl.id + '" selected>' + shopurl.category_borabora_name + '</option>');
                    else
                        $shopurl.append('<option value="' + shopurl.id + '">' + shopurl.category_borabora_name + '</option>');

                });
            });
        });

        $(document).ready(function () {
            $(".shopurl option[value='0']").attr("disabled", "disabled");
            $('#shop').trigger("change");

            $('.chkall').on('click', function () {
                var checkAll = this.checked;
                $('input[type=checkbox]').each(function () {
                    this.checked = checkAll;
                });
            });

            @if(!empty(Session::get('error_code')) && Session::get('error_code') != 'null')
            $(function () {
                $('#productModal_fail').modal('show');
            });

            @elseif(!empty(Session::get('error_code')) && Session::get('error_code') == 'null')
            $(function () {
                $('#productModal_success').modal('show');
            });

            @endif
        });


    </script>
@endsection


