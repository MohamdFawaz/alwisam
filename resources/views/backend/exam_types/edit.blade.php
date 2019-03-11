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
    <form action="{{route('backend.exam-type.update',$type->id)}}" method="POST">
        {{csrf_field()}}
        {{method_field('PATCH')}}
    <div class="form-layout form-layout-3">
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="form-group">
                    <input class="form-control" type="text" name="name" placeholder="{{trans('admin.exam_type.name')}}" value="{{$type->name}}">
                </div>
            </div><!-- col-4 -->
        </div><!-- row -->
        <div class="form-layout-footer pd-20 bd-t-0">
            <button type="submit" class="btn btn-info">{{trans('admin.actions.update')}}</button>
        </div><!-- form-group -->
    </div>
    </form>
@endsection

@section('script')
    <script src="{{asset('public/lib/select2/js/select2.min.js')}}"> </script>
@endsection