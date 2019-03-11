@extends('backend.layouts.default')

@section('breadcrumb')
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('backend.dashboard')}}">{{trans('admin.breadcrumb.dashboard')}}</a>
            <span class="breadcrumb-item active">{{trans('admin.breadcrumb.question')}}</span>
        </nav>
    </div><!-- br-pageheader -->
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('public/lib/select2/css/select2.min.css')}}">
@endsection

@section('content')
    <form action="{{route('backend.questions.store')}}" method="POST" class="form-layout form-layout-2">
        {{csrf_field()}}
        {{method_field('POST')}}
        <div >
            <div class="row no-gutters">
                <!--<div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group">
                        <label class="form-control-label">{{trans('admin.questions.question')}}: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="firstname" required placeholder="Enter firstname">
                    </div>
                </div>--><!-- col-4 -->
                <div class="col-md-8  mg-t--1 mg-md-t-0">
                    <div class="form-group ">
                        <label class="form-control-label">{{trans('admin.questions.question')}}<span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="address" placeholder="{{trans('admin.questions.question_placeholder')}}">
                    </div>
                </div><!-- col-8 -->
                <div class="col-md-4">
                    <div class="form-group mg-md-l--1">
                        <label for="exams" class="form-control-label mg-b-0-force">{{trans('admin.questions.exam_name')}}: <span class="tx-danger">*</span></label>
                        <select id="exams" class="form-control" required>
                            <option label="{{trans('admin.questions.choose_exam')}}"></option>
                            @foreach($exams as $exam)
                                <option class="form-control" value="{{$exam->id}}">{{$exam->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div><!-- col-4 -->
            </div><!-- row -->
            <div class="row no-gutters">

                <div class="col-md-12  mg-t--1 mg-md-t-0">
                    <div class="form-group ">
                        <label class="form-control-label">{{trans('admin.questions.question')}}<span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="address" placeholder="{{trans('admin.questions.question_placeholder')}}">
                    </div>
                </div><!-- col-8 -->
            </div><!-- row -->

            <div class="form-layout-footer bd pd-20 bd-t-0">
                <button class="btn btn-info">{{trans('admin.actions.add')}}</button>
            </div><!-- form-group -->
        </div>
    </form>
@endsection

@section('script')
    <script src="{{asset('public/lib/select2/js/select2.min.js')}}"> </script>
    <script>
        $(function(){
            'use strict';

            $('.form-layout .form-control').on('focusin', function(){
                $(this).closest('.form-group').addClass('form-group-active');
            });

            $('.form-layout .form-control').on('focusout', function(){
                $(this).closest('.form-group').removeClass('form-group-active');
            });

            // Select2
            $('#select2-a, #select2-b').select2({
                minimumResultsForSearch: Infinity
            });

            $('#select2-a').on('select2:opening', function (e) {
                $(this).closest('.form-group').addClass('form-group-active');
            });

            $('#select2-a').on('select2:closing', function (e) {
                $(this).closest('.form-group').removeClass('form-group-active');
            });

        });
    </script>
@endsection