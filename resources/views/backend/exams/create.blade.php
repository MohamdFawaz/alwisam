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
    <form action="{{route('backend.exam.store')}}" method="POST" class="form-layout form-layout-2">
        {{csrf_field()}}
        {{method_field('POST')}}
        <div >
            <div class="row no-gutters">
                <div class="col-md-8  mg-t--1 mg-md-t-0">
                    <div class="form-group ">
                        <label class="form-control-label">{{trans('admin.exam.title')}}<span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="title" placeholder="{{trans('admin.exam.title_placeholder')}}">
                    </div>
                </div><!-- col-8 -->
                <div class="col-md-4">
                    <div class="form-group mg-md-l--1">
                        <label for="category" class="form-control-label mg-b-0-force">{{trans('admin.exam.category')}}: <span class="tx-danger">*</span></label>
                        <select name="category_id" id="category" class="form-control" required>
                            <option label="{{trans('admin.exam.category')}}"></option>
                            @foreach($categories as $category)
                                <option class="form-control" value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div><!-- col-4 -->
            </div><!-- row -->
            <div class="row no-gutters">
                <div class="col-md-6">
                    <div class="form-group mg-md-l--1">
                        <label for="has_code" class="form-control-label mg-b-0-force">{{trans('admin.exam.has_code')}}: <span class="tx-danger">*</span></label>
                        <input id="has_code" value="1" class="form-control"  type="checkbox" >
                    </div>
                </div><!-- col-6 -->
                <div class="col-md-6">
                    <div class="form-group ">
                        <label class="form-control-label">{{trans('admin.exam.code')}}<span class="tx-danger">*</span></label>
                        <input class="form-control" id="code" type="text" name="code" disabled placeholder="{{trans('admin.exam.code_placeholder')}}">
                    </div>
                </div><!-- col-6 -->
            </div><!-- row -->
            <div class="form-layout-footer bd pd-20 bd-t-0">
                <button id="submit-btn" class="btn btn-info">{{trans('admin.actions.add')}}</button>
            </div><!-- form-group -->
        </div>
    </form>
@endsection

@section('script')
    <script src="{{asset('public/lib/select2/js/select2.min.js')}}"> </script>
@endsection