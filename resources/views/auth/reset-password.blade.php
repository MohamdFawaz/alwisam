<!DOCTYPE html>
<html lang="{{app()->setLocale('ar')}}" dir="rtl">
<head>
  @include('backend.includes.head')
</head>

<body>

<div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">

    <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
        <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal">[</span>{{trans('admin.app_name')}}<span class="tx-normal">]</span></div>
        <div class="tx-center mg-b-60">{{trans('admin.subtitle')}}</div>
        <form method="post" action="{{route('backend.reset.password')}}">
            {{csrf_field()}}
            {{method_field('post')}}
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="{{trans('admin.login.password_placeholder')}}">
            @if ($errors->has('password'))
                <span class="tx-danger">
                      <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            {{--<a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>--}}
        </div>
            <div class="form-group">
            <input type="password" name="confirm_password" class="form-control" placeholder="{{trans('admin.login.confirm_password_placeholder')}}">
            @if ($errors->has('confirm_password'))
                <span class="tx-danger">
                      <strong>{{ $errors->first('confirm_password') }}</strong>
                </span>
            @endif
            {{--<a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>--}}
        </div><!-- form-group -->
        <button type="submit" class="btn btn-info btn-block">{{trans('admin.action.change_password')}}</button>
        </form>
    </div><!-- login-wrapper -->
</div><!-- d-flex -->

<script src="{{asset("public/lib/jquery/jquery.js")}}"></script>
<script src="{{asset("public/lib/popper.js/popper.js")}}"></script>
<script src="{{asset("public/lib/bootstrap/bootstrap.js")}}"></script>

</body>
</html>
