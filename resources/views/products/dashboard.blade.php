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

        .btn-primary {
            width: 78px !important;
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid">
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
                        <form method="get" action="{{ route('products.index') }}" id="products-manager-form">
                            {!! csrf_field() !!}

                            <tr class="col-md-9">
                                <td class="col-md-1">
                                    <div class="form-group">
                                        <h4>
                                            <small><i class="fa fa-chevron-circle-down"></i>&nbsp&nbsp재고 구분</small>
                                        </h4>
                                        <label class="radio-inline">
                                            <input type="radio" name="stock" id="Radios1" value="all" checked="all">
                                            ALL
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="stock" id="Radios2" value="1">
                                            재고<strong>유</strong>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="stock" id="Radios3" value="0">
                                            재고<strong>무</strong>
                                        </label>
                                    </div>
                                </td>

                                <td class="col-md-1">
                                    <div class="form-group">
                                        <h4>
                                            <small><i class="fa fa-chevron-circle-down"></i>&nbsp&nbsp타겟 구분</small>
                                        </h4>
                                        <label class="radio-inline">
                                            <input type="radio" name="target" id="Radios1" value="all"
                                                   checked="checked">
                                            ALL
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="target" id="Radios2" value="balaan">
                                            성인
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="target" id="Radios3" value="balaankids">
                                            키즈
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="target" id="Radios4" value="no-target">
                                            미연결
                                        </label>
                                    </div>
                                </td>
                                <td class="col-md-1">
                                    <div class="form-group">
                                        <select name=brand class="form-control input-sm">
                                            <option value="">브랜드 선택</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                        {{ old('brand') == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->brand_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td class="col-md-1">
                                    <div class="form-group">
                                        <select name=source class="form-control input-sm">
                                            <option value="">수집소스 선택</option>
                                            @foreach ($categoryurls as $categoryurl)
                                                <option value="{{ $categoryurl->id }}"
                                                        {{ old('categoryurl') == $categoryurl->id ? 'selected' : '' }}>
                                                    {{ $categoryurl->crawl_url }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td class="col-md-1">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-sm btn-primary">검 색
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </form>
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
                                <td></td>
                                <td></td>
                                <td>{{ $product->shop->name }}</td>
                                <td>{{ $product->brand->brand_name }}</td>
                                <td>{{ $product->name }}</td>
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
                                    <button type="button" class="btn btn-xs btn-success"><i class="fa fa-level-up"></i>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-xs btn-default"><i
                                                class="fa fa-align-left"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {!!  $products->links() !!}
                    </div>
                    <div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>검색 결과가 없습니다.</strong> 검색을 위해 적정한 값을 선택해 주세요.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('js/common.js') }}"></script>
@endsection

