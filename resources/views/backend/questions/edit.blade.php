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
    <form action="{{route('backend.questions.update',$question->id)}}" method="POST" class="form-layout form-layout-2">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div >
            <div class="row no-gutters">
                <div class="col-md-8  mg-t--1 mg-md-t-0">
                    <div class="form-group ">
                        <label class="form-control-label">{{trans('admin.questions.question')}}<span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="description" placeholder="{{trans('admin.questions.question_placeholder')}}" value="{{$question->description}}">
                    </div>
                </div><!-- col-8 -->
                <div class="col-md-4">
                    <div class="form-group mg-md-l--1">
                        <label for="exams" class="form-control-label mg-b-0-force">{{trans('admin.questions.exam_name')}}: <span class="tx-danger">*</span></label>
                        <select name="exam_id" id="exams" class="form-control" required>
                            <option label="{{trans('admin.questions.choose_exam')}}"></option>
                            @foreach($exams as $exam)
                                <option class="form-control" value="{{$exam->id}}" @if($question->exam_id == $exam->id) selected @endif>{{$exam->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div><!-- col-4 -->
            </div><!-- row -->
            @foreach($question->answers as $key=>$answer)
            <div class="row no-gutters">
                <div class="col-md-6 ">
                    <div class="form-group ">
                        <label class="form-control-label">{{trans('admin.questions.fr_answer')}}<span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="answers[]" value="{{$answer->answer_text}}" placeholder="{{trans('admin.questions.answer_placeholder')}}">
                    </div>
                </div><!-- col-8 -->
                <div class="col-md-6">
                    <div class="form-group mg-md-l--1">
                        <label for="is_correct_{{$key}}" class="form-control-label mg-b-0-force">{{trans('admin.questions.is_correct')}}: <span class="tx-danger">*</span></label>
                        <input id="is_correct_{{$key}}" class="form-control" type="radio" @if($answer->is_correct) checked @endif value="1" name="is_correct[]">
                        <input id='is_correct_{{$key}}_hidden' type='hidden' value='0' name='is_correct[]'>
                    </div>
                </div><!-- col-4 -->
            </div><!-- row -->
            @endforeach
            {{--<div class="row no-gutters">--}}
                {{--<div class="col-md-6 ">--}}
                    {{--<div class="form-group ">--}}
                        {{--<label class="form-control-label">{{trans('admin.questions.sec_answer')}}<span class="tx-danger">*</span></label>--}}
                        {{--<input class="form-control" type="text" name="answers[]" placeholder="{{trans('admin.questions.answer_placeholder')}}">--}}
                    {{--</div>--}}
                {{--</div><!-- col-8 -->--}}
                {{--<div class="col-md-6">--}}
                    {{--<div class="form-group mg-md-l--1">--}}
                        {{--<label for="is_correct_2" class="form-control-label mg-b-0-force">{{trans('admin.questions.is_correct')}}: <span class="tx-danger">*</span></label>--}}
                        {{--<input id="is_correct_2" class="form-control" type="radio" value="1" name="is_correct[]">--}}
                        {{--<input id='is_correct_2_hidden' type='hidden' value='0' name='is_correct[]'>--}}
                    {{--</div>--}}
                {{--</div><!-- col-4 -->--}}
            {{--</div><!-- row -->--}}
            {{--<div class="row no-gutters">--}}
                {{--<div class="col-md-6 ">--}}
                    {{--<div class="form-group ">--}}
                        {{--<label class="form-control-label">{{trans('admin.questions.thr_answer')}}<span class="tx-danger">*</span></label>--}}
                        {{--<input class="form-control" type="text" name="answers[]" placeholder="{{trans('admin.questions.answer_placeholder')}}">--}}
                    {{--</div>--}}
                {{--</div><!-- col-8 -->--}}
                {{--<div class="col-md-6">--}}
                    {{--<div class="form-group mg-md-l--1">--}}
                        {{--<label for="is_correct_3" class="form-control-label mg-b-0-force">{{trans('admin.questions.is_correct')}}: <span class="tx-danger">*</span></label>--}}
                        {{--<input id="is_correct_3" class="form-control" type="radio" value="1" name="is_correct[]">--}}
                        {{--<input id='is_correct_3_hidden' type='hidden' value='0' name='is_correct[]'>--}}
                    {{--</div>--}}
                {{--</div><!-- col-4 -->--}}
            {{--</div><!-- row -->--}}
            {{--<div class="row no-gutters">--}}
                {{--<div class="col-md-6 ">--}}
                    {{--<div class="form-group ">--}}
                        {{--<label class="form-control-label">{{trans('admin.questions.fou_answer')}}<span class="tx-danger">*</span></label>--}}
                        {{--<input class="form-control" type="text" name="answers[]" placeholder="{{trans('admin.questions.answer_placeholder')}}">--}}
                    {{--</div>--}}
                {{--</div><!-- col-8 -->--}}
                {{--<div class="col-md-6">--}}
                    {{--<div class="form-group mg-md-l--1">--}}
                        {{--<label for="is_correct_4" class="form-control-label mg-b-0-force">{{trans('admin.questions.is_correct')}}: <span class="tx-danger">*</span></label>--}}
                        {{--<input id="is_correct_4" class="form-control" type="radio" value="1" name="is_correct[]">--}}
                        {{--<input id='is_correct_4_hidden' type='hidden' value='0' name='is_correct[]'>--}}
                    {{--</div>--}}
                {{--</div><!-- col-4 -->--}}
            {{--</div><!-- row -->--}}
            <div class="row no-gutters">
                <div class="col-md-12 ">
                    <div class="form-group mg-md-l--1">
                        <textarea rows="3" class="form-control" name="hint" placeholder="{{trans('admin.questions.hint')}}">{{($question->hint->hint_text) ?? ""}}</textarea>
                    </div>
                </div>
            </div>
            <div class="form-layout-footer bd pd-20 bd-t-0">
                <button id="submit-btn" class="btn btn-info">{{trans('admin.actions.update')}}</button>
            </div><!-- form-group -->
        </div>
    </form>
@endsection

@section('script')
    <script src="{{asset('public/lib/select2/js/select2.min.js')}}"> </script>
    <script>
        $('#submit-btn').on('click',function () {
            if ($("#is_correct_0").checked){
                $("#is_correct_0_hidden").prop('disabled',true);
            }
            if ($("#is_correct_1").checked){
                $("#is_correct_1_hidden").prop('disabled',true);
            }
            if ($("#is_correct_2").checked){
                $("#is_correct_2_hidden").prop('disabled',true);
            }
            if ($("#is_correct_3").checked){
                $("#is_correct_3_hidden").prop('disabled',true);
            }
        });
    </script>
@endsection