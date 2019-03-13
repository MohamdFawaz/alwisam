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
    <link rel="stylesheet" href="{{asset('public/lib/select2/css/select2.min.css')}}">
@endsection

@section('content')
    <form action="{{route('backend.category.update',$category->id)}}" method="POST" enctype="multipart/form-data" class="form-layout form-layout-2">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div >
            <div class="row no-gutters">
                <div class="col-md-12  mg-t--1 mg-md-t-0">
                    <div class="form-group ">
                        <label class="form-control-label">{{trans('admin.category.name')}}<span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="name" placeholder="{{trans('admin.category.name_placeholder')}}" value="{{$category->name}}">
                    </div>
                </div><!-- col-8 -->
            </div><!-- row -->
            <div class="row no-gutters bd ">
                <div class="col-md-12 tx-center-force">
                    <img src="{{$category->image}}" alt="category-image" style="width: 250px"/>
                    <div class="row no-gutters ">
                        <div class="col-lg-12 tx-center-force">
                            <label class="custom-file">
                                <input type="file" name="image" id="file2" class="custom-file-input">
                                <span class="custom-file-control custom-file-control-primary"></span>
                            </label>
                        </div>
                    </div>

                </div>

            </div><!-- row -->
            <div class="form-layout-footer bd pd-20 bd-t-0">
                <button id="submit-btn" class="btn btn-info">{{trans('admin.actions.update')}}</button>
            </div><!-- form-group -->
        </div>
    </form>
@endsection

@section('script')
    <script src="{{asset('public/lib/select2/js/select2.min.js')}}"> </script>
@endsection