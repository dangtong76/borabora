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
                <small><p class="text-info"><i class="fa fa-fw fa-cloud-download"></i>&nbsp&nbsp수집정보</p></small>
            </h3>
        </div>
    </div>

    <div class="panel">
        <div class="panel-heading"></div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-condensed table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center" scope="row">
                            <input type="checkbox" name="chkall" id="chkall"/>
                        </th>
                        <th class="text-left">수집고유번호</th>
                        <th class="text-left">수집업체</th>
                        <th class="text-center">수집 활성화</th>
                        <th class="text-left">수집대상 전체</th>
                        <th class="text-left">수집성공</th>
                        <th class="text-left">수집실패</th>
                        <th class="text-left">수집성공율</th>
                        <th class="text-left">성인몰 진열</th>
                        <th class="text-left">키즈몰 진열</th>
                        <th class="text-center">수집하기</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($shops as $shop)
                        <tr>
                            <td class="text-center rowlink-skip" scope="row">
                                <input type="checkbox" name="chk[]" class="list-chkbox" value="#">
                            </td>

                            <td class="row-link">{{ $shop->id }}
                                <a id="shopurls_in_shop" href="{{ route('shopurls.index', $shop->id) }}"></a>
                            </td>
                            <td class="row-link">{{ $shop->name }}
                                <a id="shopurls_in_shop" href="{{ route('shopurls.index', $shop->id) }}"></a>
                            </td>

                            <td class="text-center">
                                @if($shop->crawl_yn == '1')
                                    <button type="button" class="btn btn-xs btn-info">Enabled</button>
                                @else
                                    <button type="button" class="btn btn-xs btn-warn">Disabled</button>
                                @endif
                            </td>

                            <td class="row-link">{{ $shop->products->count() }}
                                <a id="shopurls_in_shop" href="{{ route('shopurls.index', $shop->id) }}"></a>
                            </td>

                            {{-- 수집 성공 개수 --}}
                            <td class="row-link">{{ $shop->products->where('crawl_last_status','=','1')->count() }}
                                <a id="shopurls_in_shop" href="{{ route('shopurls.index', $shop->id) }}"></a>
                            </td>

                            {{-- 수집 실패 개수 --}}
                            <td class="row-link">{{ $shop->products->where('crawl_last_status','=','0')->count() }}
                                <a id="shopurls_in_shop" href="{{ route('shopurls.index', $shop->id) }}"></a>
                            </td>

                            {{-- 수집 성공율 --}}
                            @if(($shop->products->count()) != '0' && ($shop->products->where('crawl_last_status','=','1')->count()) != '0' && round(($shop->products->where('crawl_last_status','=','1')->count())/($shop->products->count())*100,1) >= 50)
                                @php $crawl_high_rate = round(($shop->products->where('crawl_last_status','=','1')->count())/($shop->products->count())*100,1) @endphp
                                <td class="row-link">
                                    <div class="progress" style="margin:0px;">
                                        <div class="progress-bar progress-bar-success" role="progressbar"
                                             aria-valuenow="{{ $crawl_high_rate }}"
                                             aria-valuemin="0" aria-valuemax="100" style="width:{{$crawl_high_rate}}%">
                                            <span class="sr-only">{{ $crawl_high_rate }}%</span>
                                        </div>
                                    </div>
                                </td>
                            @elseif(($shop->products->count()) != '0' && ($shop->products->where('crawl_last_status','=','1')->count()) != '0' && round(($shop->products->where('crawl_last_status','=','1')->count())/($shop->products->count())*100,1) < 50)
                                @php $crawl_row_rate = round(($shop->products->where('crawl_last_status','=','1')->count())/($shop->products->count())*100,1) @endphp
                                <td class="row-link">
                                    <div class="progress" style="margin:0px;">
                                        <div class="progress-bar progress-bar-danger" role="progressbar"
                                             aria-valuenow="{{ $crawl_row_rate }}"
                                             aria-valuemin="0" aria-valuemax="100" style="width:{{$crawl_row_rate}}%">
                                            <span class="sr-only">{{ $crawl_row_rate }}%</span>
                                        </div>
                                    </div>
                                </td>
                            @else
                                <td class="row-link">
                                    <div class="progress" style="margin:0px;">
                                        <div class="progress-bar progress-bar-danger" role="progressbar"
                                             aria-valuenow="0"
                                             aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                            <span class="sr-only" style="color: black;">N/A</span>
                                        </div>
                                    </div>
                                </td>
                            @endif

                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-xs btn-default crawl"><i class="fa fa-hand-lizard-o"></i>
                                </button>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {!! $shops->appends(Input::except('page'))->links() !!}
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
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

