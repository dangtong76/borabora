{{--
작성자 : 변현창
내용 : 사용자 로그인 FROM
--}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>시스템 사용자 등록</strong></div>
                    <div class="panel-body">
                        <form class="form-horizontal"
                              role="form"
                              method="POST"
                              action="{{ route('members.register.submit') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">
                                </label>
                                <div class="col-md-6">
                                    <input id="name"
                                           type="text"
                                           placeholder="이름"
                                           class="form-control"
                                           name="name"
                                           value="{{ old('name') }}"
                                           autofocus>
                                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-3 control-label">
                                </label>

                                <div class="col-md-6">
                                    <input
                                            id="email"
                                            type="email"
                                            placeholder="이메일"
                                            class="form-control"
                                            name="email"
                                            value="{{ old('email') }}">
                                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-3 control-label">
                                </label>

                                <div class="col-md-6">
                                    <input
                                            id="password"
                                            type="password"
                                            placeholder="패스워드"
                                            class="form-control"
                                            name="password">

                                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm"
                                       class="col-md-3 control-label">
                                </label>

                                <div class="col-md-6">
                                    <input id="password-confirm"
                                           type="password"
                                           placeholder="패스워드 확인"
                                           class="form-control"
                                           name="password_confirmation">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">
                                        사용자 등록 요청
                                    </button>
                                </div>
                            </div>
                            <br>
                            <div class="text-nowrap" align="center">
                                | 사용자 등록 요청은 관리자에게 전송되며, 관리자 승인후 시스템 사용이 가능합니다 |
                                <br>
                                | 관리자 연락처 : 010-8544-0170 변현창 |
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection