@extends('backend.layouts.default')

@section('breadcrumb')
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('backend.dashboard')}}">{{trans('admin.breadcrumb.dashboard')}}</a>
            <span class="breadcrumb-item active">{{trans('admin.breadcrumb.exam')}}</span>
        </nav>
    </div><!-- br-pageheader -->
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('public/lib/datatables/jquery.dataTables.css')}}">
    <link rel="stylesheet" href="{{asset('public/lib/jquery-toggles/toggles-full.css')}}">

    <link href="{{asset('public/lib/jquery-toggles/toggles-full.css')}}" rel="stylesheet">
    <link href="{{asset('public/lib/jt.timepicker/jquery.timepicker.css')}}" rel="stylesheet">
    <link href="{{asset('public/lib/spectrum/spectrum.css')}}" rel="stylesheet">
    <link href="{{asset('public/lib/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">
    <link href="{{asset('public/lib/ion.rangeSlider/css/ion.rangeSlider.css')}}" rel="stylesheet">
    <link href="{{asset('public/lib/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="table-wrapper">
        <div class="">
            <a class="btn btn-success" href="{{route('backend.exam.create')}}">{{trans('admin.actions.create')}}</a>
        </div>
        <table id="datatable2" class="table display responsive nowrap" dir="rtl">
            <thead>
            <tr>
                <th class="wd-15p">{{trans('admin.table.id')}}</th>
                <th class="wd-15p">{{trans('admin.exam.title')}}</th>
                <th class="wd-15p">{{trans('admin.exam.category')}}</th>
                <th class="wd-15p">{{trans('admin.actions.actions')}}</th>
            </tr>
            </thead>
            <tbody>
           @foreach($exams as $exam)
            <tr>
                <td>{{$exam->id}}</td>
                <td>{{$exam->title}}</td>
                <td>{{$exam->category->name}}</td>
                <td>{!!$exam->action!!}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <script src="{{asset('public/lib/datatables/jquery.dataTables.js')}}"> </script>

    <script src="{{asset('public/lib/jquery-toggles/toggles.min.js')}}"></script>
    <script src="{{asset('public/lib/jt.timepicker/jquery.timepicker.js')}}"></script>
    <script src="{{asset('public/lib/spectrum/spectrum.js')}}"></script>
    <script src="{{asset('public/lib/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
    <script src="{{asset('public/lib/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('public/lib/ion.rangeSlider/js/ion.rangeSlider.min.js')}}"></script>


    <script>
        $(function() {
            'use strict';
            $('#datatable2').DataTable({
                bLengthChange: false,
                responsive: true,
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
                }
            });
        });
        function addImportFile(exam_id)
        {
            $("#form-"+exam_id).submit();
        }
    </script>

@endsection