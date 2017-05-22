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

        .progress {
            position: relative;
        }

        .progress-bar {
            z-index: 1;
            position: absolute;
        }

        .progress span {
            position: relative;
            top: 0;
            z-index: 2;
            color: white;
            text-align: left;
            width: 100%;
        }
        td.row-link:hover {
            cursor: pointer;
        }

    </style>
@endsection

@section('content')
    <div class="panel">
        <div class="panel-body">
            <h3>
                <small><p class="text-info"><i class="fa fa-fw fa-cloud-download"></i>&nbsp&nbsp수집정보 > 수집 카테코리</p></small>
            </h3>
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
                        <th class="text-left">수집 URL ID</th>
                        <th class="text-left">업체카테고리</th>
                        <th class="text-left">발란카테고리</th>
                        <th class="text-center">수집 URL</th>
                        <th class="text-left">수집형태</th>
                        <th class="text-left">수집대상 전체</th>
                        <th class="text-left">수집성공</th>
                        <th class="text-left">수집실패</th>
                        <th class="text-left">수집성공율</th>
                        <th class="text-center">수집하기</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tbody>
                    @foreach ($shopurls as $shopurl)
                        <tr>
                            <th class="text-center" scope="row">
                                <input type="checkbox" name="chk[]" class="list-chkbox" value="#">
                            </th>
                            <td>{{ $shopurl->id }}</td>
                            <td>{{ $shopurl->category_origin_name }}</td>
                            <td>{{ $shopurl->category_borabora_name }}</td>

                            <td class="text-center">{{ $shopurl->crawl_url }}</td>

                            <td>{{ $shopurl->crawl_type }}</td>
                            <td>{{ $shopurl->products->count() }}</td>
                            {{-- 수집 성공 개수 --}}
                            <td>{{ $shopurl->products->where('crawl_last_status','=','1')->count() }}</td>
                            {{-- 수집 실패 개수 --}}
                            <td>{{ $shopurl->products->where('crawl_last_status','=','0')->count() }}</td>
                            {{-- 수집 성공율 --}}
                            @if(($shopurl->products->count()) != '0' && ($shopurl->products->where('crawl_last_status','=','1')->count()) != '0' && round(($shopurl->products->where('crawl_last_status','=','1')->count())/($shopurl->products->count())*100,1) >= 50)
                                @php $crawl_high_rate = round(($shopurl->products->where('crawl_last_status','=','1')->count())/($shopurl->products->count())*100,1) @endphp
                                <td>
                                    <div class="progress" style="margin:0px;">
                                        <div class="progress-bar progress-bar-success" role="progressbar"
                                             aria-valuenow="{{ $crawl_high_rate }}"
                                             aria-valuemin="0" aria-valuemax="100" style="width:{{$crawl_high_rate}}%">
                                            <span class="sr-only">{{ $crawl_high_rate }}%</span>
                                        </div>
                                    </div>
                                </td>
                            @elseif(($shopurl->products->count()) != '0' && ($shopurl->products->where('crawl_last_status','=','1')->count()) != '0' && round(($shopurl->products->where('crawl_last_status','=','1')->count())/($shopurl->products->count())*100,1) < 50)
                                @php $crawl_row_rate = round(($shopurl->products->where('crawl_last_status','=','1')->count())/($shopurl->products->count())*100,1) @endphp
                                <td>
                                    <div class="progress" style="margin:0px;">
                                        <div class="progress-bar progress-bar-danger" role="progressbar"
                                             aria-valuenow="{{ $crawl_row_rate }}"
                                             aria-valuemin="0" aria-valuemax="100" style="width:{{$crawl_row_rate}}%">
                                            <span class="sr-only">{{ $crawl_row_rate }}%</span>
                                        </div>
                                    </div>
                                </td>
                            @else
                                <td>
                                    <div class="progress" style="margin:0px;">
                                        <div class="progress-bar progress-bar-danger" role="progressbar"
                                             aria-valuenow="0"
                                             aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                            <span class="sr-only" style="color: black;">N/A</span>
                                        </div>
                                    </div>
                                </td>
                            @endif
                            <td class="text-center">
                                <button type="button" class="btn btn-xs btn-default"><i
                                            class="fa fa-hand-lizard-o"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                    <div class="pager">
                        <li class="previous"><a href="{{ route('shops.index') }}"><i class="fa fa-caret-left"></i> 이전페이지</a></li>
                    </div>

                <div class="text-center">
                    {!! $shopurls->appends(Input::except('page'))->links() !!}
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('div.table-responsive > table > tbody > tr > td').click(function () {
                var href = $(this).find("a").attr("href");
                if (href) {
                    window.location = href;
                }
            })
        });
    </script>
@endsection

