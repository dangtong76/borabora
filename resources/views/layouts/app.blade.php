<!DOCTYPE html>
<body lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BoraBora') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    @yield('style')


<!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="layout-basic menu-no-border" style="overflow-x:hidden; overflow-y:auto;">
<div id="cssmenu">
    <ul>
        <li class="has-sub"><a href="#"><span><i class="fa fa-fw fa-cloud-download"></i> 수집관리</span></a>
            <ul>
                <li><a href="#"><span>수집 상태 전체</span></a></li>
                <li class="has-sub"><a href="#"><span>수집 타입별 보기</span></a>
                    <ul>
                        <li><a href="#"><span>Web Page</span></a></li>
                        <li><a href="#"><span>Excel</span></a></li>
                        <li><a href="#"><span>API</span></a></li>
                        <li><a href="#"><span>PDF</span></a></li>
                    </ul>
                </li>
                <li class="has-sub"><a href="#"><span>수집 대상별 보기</span></a>
                    <ul>
                        <li><a href="#"><span>ELITE</span></a></li>
                        <li><a href="#"><span>MONDO</span></a></li>
                    </ul>
                </li>
                <li><a href="#"><span>수집 비활성 보기</span></a></li>
                <li><a href="#"><span>수집 히스토리</span></a></li>
            </ul>
        </li>
        <li class="has-sub"><a href="#"><span><i class="fa fa-fw fa-shopping-bag"></i> 상품관리</span></a>
            <ul>
                <li><a href="#"><span>수집 대상별 상품보기</span></a></li>
                <li class="has-sub"><a href="#"><span>타겟별 상품보기</span></a>
                    <ul>
                        <li><a href="#"><span>www.balaan.co.kr</span></a></li>
                        <li><a href="#"><span>www.balaankids.co.kr</span></a></li>
                    </ul>
                </li>
                <li class="has-sub"><a href="#"><span>브랜드별 상품보기</span></a>
                    <ul>
                        <li><a href="#"><span>GUCCHI</span></a></li>
                        <li><a href="#"><span>FENDI</span></a></li>
                        <li><a href="#"><span>BUBBERY</span></a></li>
                    </ul>
                </li>
                <li><a href="#"><span>신규상품 (7일 이내)</span></a></li>
                <li><a href="#"><span>상품변경 히스토리</span></a></li>
                <li><a href="#"><span>미연결 상품</span></a></li>
                <li><a href="#"><span>삭제상품관리</span></a></li>
            </ul>
        </li>
        <li class="has-sub"><a href="#"><span><i class="fa fa-fw fa-cloud-upload"></i> 타겟 전송관리</span></a>
            <ul>
                <li><a href="#"><span>타겟 상태</span></a></li>
                <li><a href="#"><span>타겟 추가 / 삭제</span></a></li>
                <li><a href="#"><span>타겟 상태 히스토리</span></a></li>
            </ul>
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
@yield('menu')
@yield('content')
<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
@yield('scripts')
</body>



