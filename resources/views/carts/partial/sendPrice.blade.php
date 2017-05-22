@extends('layouts.app')


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
        @foreach ($delete_carts as $delete_cart)
            <tr>
                <th class="text-center" scope="row">
                    <input type="checkbox" name="chk[]" class="list-chkbox" value="#">
                </th>
                <td>{{ $delete_cart->id }}</td>
                <td>{{ isset($delete_cart->id) ? $delete_cart->id : null}}</td>
                <td>{{ isset($delete_cart->id) ? $delete_cart->id : null }}</td>
                <td>{{ $delete_cart->id }}</td>
                <td>{{ $delete_cart->id }}</td>
                <td>{{ $delete_cart->id }}</td>
                <td>{{ isset($delete_cart->id) ? $delete_cart->id: '0' }}</td>
                <td>{{ $delete_cart->id }}</td>
                <td>{{ $delete_cart->id }}</td>
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

                </td>
                <td class="text-center">

                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <div class="text-center">
        {!! $delete_carts->appends(Input::except('page'))->links() !!}
    </div>
</div>




