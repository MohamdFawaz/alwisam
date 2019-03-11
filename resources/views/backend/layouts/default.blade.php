<!DOCTYPE html>
<html {{app()->setLocale('ar')}} lang="ar" dir="rtl">
    <head>
        @include('backend.includes.head')
    </head>
    <body>
        @include('backend.includes.sidebar')

        @include('backend.includes.head_panel')

        @include('backend.includes.right_panel')
        <div class="br-mainpanel">
            @yield('breadcrumb')
            <div class="br-pagebody ">
                <div class="br-section-wrapper">

                @yield('content')
                </div>
            </div><!-- br-pagebody -->
        </div>

        @include('backend.includes.footer')
    </body>
</html>
