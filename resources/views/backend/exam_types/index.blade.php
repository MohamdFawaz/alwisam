@extends('backend.layouts.default')

@section('breadcrumb')
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('backend.dashboard')}}">{{trans('admin.breadcrumb.dashboard')}}</a>
            <span class="breadcrumb-item active">{{trans('admin.breadcrumb.category')}}</span>
        </nav>
    </div><!-- br-pageheader -->
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('public/lib/datatables/jquery.dataTables.css')}}">
@endsection

@section('content')
    <div class="table-wrapper">
        <table id="datatable2" class="table display responsive nowrap" dir="rtl">
            <thead>
            <tr>
                <th class="wd-15p">{{trans('admin.table.id')}}</th>
                <th class="wd-15p">{{trans('admin.exam_type.name')}}</th>
                <th class="wd-15p">{{trans('admin.actions.actions')}}</th>
            </tr>
            </thead>
            <tbody>
           @foreach($exam_types as $exam_type)
            <tr>
                <td>{{$exam_type->id}}</td>
                <td>{{$exam_type->name}}</td>
                <td>{!!$exam_type->action!!}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <script src="{{asset('public/lib/datatables/jquery.dataTables.js')}}"> </script>
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
    </script>

@endsection