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
                <small><p class="text-info"><i class="fa fa-shopping-cart"></i>&nbsp&nbsp Action Cart</p></small>
            </h3>
        </div>
    </div>
    <div class="panel">
    @php $id = \Illuminate\Support\Facades\Auth::id() @endphp
    <ul class="nav nav-tabs">
        <li {{($menuId == '1') ? 'class=active' : '' }}>
            <a href="{{route('carts.index',['memberId' => $id,'menuId' =>'1'])}}"><i class="glyphicon glyphicon-send"></i> 송출</a>
        </li>

        <li {{($menuId == '2') ? 'class=active' : '' }}>
            <a href="{{route('carts.index',['memberId' => $id,'menuId' =>'2'])}}"><i class="fa fa-trash"></i> 삭제</a>
        </li>

        <li {{($menuId == '3') ? 'class=active' : '' }}>
            <a href="{{route('carts.index',['memberId' => $id,'menuId' =>'3'])}}"><i class="fi-dollar"></i> 가격 재전송</a>
        </li>

    </ul>
    <br>


    @if($menuId == '1')
        @include('carts.partial.sendAll')

    @elseif($menuId == '2')
        @include('carts.partial.delete')

    @elseif($menuId == '3')
        @include('carts.partial.sendPrice')

    @endif

        <div class="btn-group">
            <button type="button" class="btn btn-info"><i class="fa fa-cart-arrow-down"></i> Add To Cart
            </button>
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#"> 송출</a></li>
                <li><a href="#"> 삭제</a></li>
                <li><a href="#"> 가격재전송</a></li>
            </ul>
        </div>

    </div>
@endsection


