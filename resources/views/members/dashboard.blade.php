@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="panel-body">
            <div class="panel">
                <h3>
                    <small><p class="text-info"><i class="fa fa-shopping-bag"></i>상품관리</p></small>
                </h3>
            </div>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" role="form">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-offset-6">
                            <div class="col-sm-2">
                                <input type="email" class="form-control inputstl" id="name1"
                                       placeholder="Enter Your Full Name">
                            </div>
                        </div>
                        <div class="col-md-offset-6">
                            <div class="col-sm-2">
                                <input type="email" class="form-control inputstl" id="name1"
                                       placeholder="Enter Your Full Name">
                            </div>
                        </div>
                        <div class="col-md-offset-6">
                            <div class="col-sm-2">
                                <input type="email" class="form-control inputstl" id="name1"
                                       placeholder="Enter Your Full Name">
                            </div>
                        </div>
                        <div class="col-md-offset-6">
                            <div class="col-sm-2">
                                <input type="email" class="form-control inputstl" id="name1"
                                       placeholder="Enter Your Full Name">
                            </div>
                        </div>
                        <div class="col-md-offset-6">
                            <div class="col-sm-2">
                                <input type="email" class="form-control inputstl" id="name1"
                                       placeholder="Enter Your Full Name">
                            </div>
                        </div>
                        <div class="span1 col-md-offset-6">
                            <div class="col-sm-2">
                                <button type="submit" class="btn-sm btn-block btn-info">검색</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-condensed background-color: black">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">상품정보</th>
                        <th class="text-center">카테고리</th>
                        <th class="text-center">제고</th>
                        <th class="text-center">고도몰 연동</th>
                        <th class="text-center">키즈몰 연동</th>
                        <th class="text-center">삭제</th>
                        <th class="text-center">수정</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>Otto</td>
                        <td>Otto</td>
                        <td>Otto</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary btn-sm">삭제</button>
                        </td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>Thornton</td>
                        <td>Thornton</td>
                        <td>Thornton</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary btn-sm">삭제</button>
                        </td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>당통</td>
                        <td>만정</td>
                        <td>예준</td>
                        <td>엄마</td>
                        <td>도윤</td>
                        <td class="text-center">
                            <button type="button" data-toggle="collapse" data-target="#demo"
                                    class="btn btn-primary btn-sm">
                                삭제
                            </button>
                        </td>
                        <td>@twitter</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- 모달을 켜고 끄는 버튼 -->
    <a href="#myModal" role="button" class="btn" data-toggle="modal">모달 시연 시작</a>

    <!-- 모달 -->
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">모달 제목</h3>
        </div>
        <div class="modal-body">
            <p>한 멋진 본문…</p>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">닫기</button>
            <button class="btn btn-primary">변경사항 저장</button>
        </div>
    </div>

@endsection