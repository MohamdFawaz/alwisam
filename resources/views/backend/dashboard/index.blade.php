@extends('backend.layouts.default')
@section('css')
    <link href="{{asset('public/lib/morris.js/morris.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5">{{trans('admin.app_name')}} {{trans('admin.dashboard.dashboard')}}</h4>
    </div><!-- d-flex -->

    <div class="br-pagebody mg-t-5 pd-x-30">
        <div class="row row-sm">
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
                <div class="bg-info rounded overflow-hidden">
                    <div class="pd-25 d-flex align-items-center" style="padding: 21px;">
                        <i class="ion ion-clock tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">{{trans('admin.dashboard.time')}}</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1 plugin-clock">00:00</p>
                            <span class="tx-11 tx-roboto tx-white-6 plugin-date">00-00-0000</span>
                        </div>
                    </div>
                </div>
            </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
                <div class="bg-danger rounded overflow-hidden">
                    <div class="pd-25 d-flex align-items-center">
                        <i class="ion ion-bag tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">{{trans('admin.dashboard.registered_users')}}</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{$registeredUsersCount}}</p>
                        </div>
                    </div>
                </div>
            </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                <div class="bg-primary rounded overflow-hidden">
                    <div class="pd-25 d-flex align-items-center">
                        <i class="ion ion-monitor tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">{{trans('admin.dashboard.exams')}}</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{$examsCount}}</p>
                        </div>
                    </div>
                </div>
            </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                <div class="bg-br-primary rounded overflow-hidden">
                    <div class="pd-25 d-flex align-items-center">
                        <i class="ion ion-clock tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">{{trans('admin.dashboard.`')}}</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{$examsCodeCount}}</p>
                        </div>
                    </div>
                </div>
            </div><!-- col-3 -->
        </div><!-- row -->
        <div class="card shadow-base card-body pd-25 bd-0 mg-t-20">
            <div class="row">
                <div class="col-sm-6">
                    <h6 class="card-title tx-uppercase tx-12">{{trans('admin.dashboard.answered_exams')}}</h6>
                    <p class="display-4 tx-medium tx-inverse mg-b-5 tx-lato">{{floor($answeredExamsCount/$examsCount)}}%</p>
                    <div class="progress mg-b-10">
                        <div class="progress-bar bg-primary progress-bar-xs wd-30p" role="progressbar" aria-valuenow="{{floor($answeredExamsCount/$examsCount)}}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div><!-- progress -->
                </div><!-- col-6 -->
                <div class="col-sm-6 mg-t-20 mg-sm-t-0 d-flex align-items-center justify-content-center">
                    <span class="peity-donut" data-peity='{ "fill": ["#0866C6", "#E9ECEF"],  "innerRadius": 50, "radius": 90 }'>{{floor($examsCount)}}/{{floor($answeredExamsCount)}}</span>
                </div><!-- col-6 -->
            </div><!-- row -->
        </div><!-- card -->

        <div class="row">
            <div class="col-xl-12">
                <div id="morrisLine1" class="ht-200 ht-sm-300 bd"></div>
            </div><!-- col-6 -->
        </div><!-- row -->
        <div class="card bd-0 shadow-base pd-30 mg-t-20">
            <div class="d-flex align-items-center justify-content-between mg-b-30">
                <div>
                    <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">{{trans('admin.suggestion.recent_suggestions')}}</h6>
                </div>
            </div><!-- d-flex -->

            <table class="table table-valign-middle mg-b-0">
                <tbody>
                @foreach($suggestions as $suggestion)
                <tr>
                    <td>
                        <h6 class="tx-inverse tx-14 mg-b-0">{{$suggestion->subject}}</h6>
                    </td>
                    <td>{{\Carbon\Carbon::parse()->toDateTimeString()}}</td>
                    <td><span id="sparkline1">{{$suggestion->message}}</span></td>
                    <td class="pd-r-0-force tx-center"></td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div><!-- card -->

    </div><!-- col-9 -->
@endsection


@section('script')
    <script>
        let url = "{{route('backend.dashboard.line.chart')}}";
    </script>
    <script src="{{asset("public/js/chart.peity.js")}}"></script>
    <script src="{{asset("public/lib/jquery-switchbutton/jquery.switchButton.js")}}"></script>
    <script src="{{asset('public/js/chart.morris.js')}}"></script>
    <script src="{{asset('public/lib/morris.js/morris.js')}}"></script>
    <script src="{{asset('public/lib/raphael/raphael.min.js')}}"></script>
{{--        <script src="{{asset("public/js/chart.chartist.js")}}"></script>--}}
    <script src="{{asset("public/js/dashboard.js")}}"></script>

@endsection