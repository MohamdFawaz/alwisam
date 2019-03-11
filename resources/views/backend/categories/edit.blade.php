@extends('backend.layouts.default')

@section('breadcrumb')
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('backend.dashboard')}}">{{trans('admin.breadcrumb.dashboard')}}</a>
            <span class="breadcrumb-item active">{{trans('admin.breadcrumb.exam_type')}}</span>
        </nav>
    </div><!-- br-pageheader -->
@endsection


@section('css')
    <link rel="stylesheet" href="{{asset('public/lib/select2/css/select2.min.css')}}">
@endsection

@section('content')
    <form action="{{route('backend.exam-type.update',$category->id)}}" method="PATCH" class="form-layout form-layout-3">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="form-control" type="text" name="firstname" placeholder="Enter firstname (required)">
                    </div>
                </div><!-- col-4 -->
                <div class="col-md-4 mg-t--1 mg-md-t-0">
                    <div class="form-group mg-md-l--1">
                        <input class="form-control" type="text" name="lastname" placeholder="Enter lastname (required)">
                    </div>
                </div><!-- col-4 -->
                <div class="col-md-4 mg-t--1 mg-md-t-0">
                    <div class="form-group mg-md-l--1">
                        <input class="form-control" type="text" name="email" placeholder="Enter email address">
                    </div>
                </div><!-- col-4 -->
                <div class="col-md-8">
                    <div class="form-group bd-t-0-force">
                        <input class="form-control" type="text" name="address" placeholder="Enter address">
                    </div>
                </div><!-- col-8 -->
                <div class="col-md-4">
                    <div class="form-group mg-md-l--1 bd-t-0-force">
                        <select id="select2-b" class="form-control select2-hidden-accessible" data-placeholder="Choose country" tabindex="-1" aria-hidden="true" style="width: 313px;">
                            <option label="Choose country"></option>
                            @foreach($parentCategories as $parentCategory)
                                <opttion value="{{$parentCategory->id}}">{{$parentCategory->name}}</opttion>
                            @endforeach
                        </select>
                        <span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" style="width: 272px;">
                            <span class="selection">
                                <span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-select2-b-container">
                                    <span class="select2-selection__rendered" id="select2-select2-b-container">
                                        <span class="select2-selection__placeholder">{{trans('admin.category.chose_parent')}}</span>

                                    </span>
                                    <span class="select2-selection__arrow" role="presentation">
                                        <b role="presentation"></b></span>
                                </span>
                            </span>
                            <span class="dropdown-wrapper" aria-hidden="true"></span>
                        </span>
                    </div>
                </div><!-- col-4 -->
            </div><!-- row -->
            <div class="form-layout-footer bd pd-20 bd-t-0">
                <button class="btn btn-info">Submit Form</button>
                <button class="btn btn-secondary">Cancel</button>
            </div><!-- form-group -->
    </form>
@endsection

@section('script')
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>--}}

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