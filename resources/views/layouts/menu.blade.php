@extends('layouts.app')
@section('menu')
<div id="cssmenu">
    <ul>
        <li class="has-sub"><a href="#"><span><i class="fa fa-fw fa-cloud-download"></i> 수집관리</span></a>
            <ul>
                <li><a href="{{ route('shops.index') }}"><span>수집 상황 모니터링</span></a></li>
                <li><a href="#"><span>수집 작업 확인</span></a></li>
                <li><a href="#"><span>수집 이력 보기</span></a></li>
                <li><a href="#"><span>수집 업체 관리</span></a></li>
            </ul>
        </li>
        <li class="has-sub"><a href="#"><span><i class="fa fa-fw fa-shopping-bag"></i> 상품관리</span></a>
            <ul>
                <li class="has-sub"><a href="{{ route('products.new') }}"><span>신규상품 관리</span></a>
                    <ul>
                        <li><a href="#"><span>발란 성인</span></a></li>
                        <li><a href="#"><span>발란 키즈</span></a></li>
                    </ul>
                </li>
                <li class="has-sub"><a href="{{ route('products.index') }}"><span>등록상품 관리</span></a>
                    <ul>
                        <li><a href="{{ route('products.index.adult')}}"><span>발란 성인</span></a></li>
                        <li><a href="{{ route('products.index.kid')}}"><span>발란 키즈</span></a></li>
                    </ul>
                </li>
                <li><a href="#"><span>상품변경 이력</span></a></li>
                <li><a href="#"><span>미연결 상품</span></a></li>
                <li><a href="#"><span>삭제상품 관리</span></a></li>
            </ul>
        </li>
        <li class="has-sub"><a href="#"><span><i class="fa fa-fw fa-cloud-upload"></i> 타겟 전송관리</span></a>
            <ul>
                <li><a href="#"><span>타겟 상태</span></a></li>
                <li><a href="#"><span>타겟 추가 / 삭제</span></a></li>
                <li><a href="#"><span>타겟 상태 히스토리</span></a></li>
            </ul>
        </li>
        @php $id=\Illuminate\Support\Facades\Auth::id() @endphp
        <li><a href="{{ route('carts.index',['memberId' => $id, 'menuId' => '1']) }}"><span><i class="fa fa-shopping-cart"></i> CART</span><span class="badge">7</span></a>

        </li>
        <li><a href="#"><span><i class="fa fa-fw fa-file-excel-o"></i> 엑셀 업로드</span></a></li>
        <li><a href="#"><span><i class="fa fa-fw fa-male"></i> 성인몰관리</span></a></li>
        <li><a href="#"><span><i class="fa fa-fw fa-street-view"></i> 키즈몰 관리</span></a></li>
        <li class="has-sub"><a href="#"><span><i class="fa fa-fw fa-gear"></i> 설정</span></a>
            <ul>
                <li><a href="#"><span>사용자 관리</span></a></li>
            </ul>
        </li>
        @if (Auth::guard('members')->guest())
            <li class="pull-right">
                <a href="{{ route('members.login') }}">
                    <span><i class="glyphicon glyphicon-log-in"></i>&nbsp&nbspLogin</span>
                </a>
            </li>
            <li>
                <a href="{{ route('members.register') }}">
                    <span><i class="fa fa-fw fa-street-view"></i>register</span>
                </a>
            </li>
        @else
            <li class="pull-right">
                <a href="#">
                    <span><i class="fa fa-sign-out"></i>&nbsp&nbsp{{ Auth::user()->name }}</span>
                </a>
                <ul>
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            <i class="glyphicon glyphicon-log-out"></i><span> LogOut</span>
                        </a>
                        <form id="logout-form"
                              action="{{ route('logout') }}"
                              method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
</div>
@endsection