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
                <small><p class="text-info"><i class="fa fa-shopping-bag"></i>&nbsp&nbsp신규 상품</p></small>
            </h3>
        </div>
    </div>

    <div class="panel">
        <div class="panel-heading"></div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table  table-striped background-color: black">
                    {!! Form::open(['route' => 'products.new', 'method' => 'get','class' =>'form']) !!}
                    <tr class="col-md-5 col-lg-5">
                        <td class="col-md-1 col-lg-1">
                            <div class="form-group">
                                <select name=daysago class="form-control input-sm">
                                    <option value="7" {{ old('daysago') == '7' ? 'selected' : '' }}>
                                        7일전
                                    </option>
                                    <option value="15" {{ old('daysago') == '15' ? 'selected' : '' }}>
                                        15일전
                                    </option>
                                    <option value="30" {{ old('daysago') == '30' ? 'selected' : '' }}>
                                        30일전
                                    </option>
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
                        <th class="text-left">고유번호</th>
                        <th class="text-left">발란코드</th>
                        <th class="text-left">키즈코드</th>
                        <th class="text-left">수집업체</th>
                        <th class="text-left">브랜드명</th>
                        <th class="text-left">상품이름</th>
                        <th class="text-left">제고</th>
                        <th class="text-left">최종수집일</th>
                        <th class="text-left">등록일자</th>
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
@section('script')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection

