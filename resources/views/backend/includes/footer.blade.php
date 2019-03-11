<footer class="br-footer">
    <div class="footer-left">
        <div class="mg-b-2">Copyright &copy; 2017. Bracket. All Rights Reserved.</div>
        <div>Attentively and carefully made by ThemePixels.</div>
    </div>
    <div class="footer-right d-flex align-items-center">
        <span class="tx-uppercase mg-r-10">Share:</span>
        <a target="_blank" class="pd-x-5" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//themepixels.me/bracket/intro"><i class="fa fa-facebook tx-20"></i></a>
        <a target="_blank" class="pd-x-5" href="https://twitter.com/home?status=Bracket,%20your%20best%20choice%20for%20premium%20quality%20admin%20template%20from%20Bootstrap.%20Get%20it%20now%20at%20http%3A//themepixels.me/bracket/intro"><i class="fa fa-twitter tx-20"></i></a>
    </div>
</footer>
<!-- ########## END: MAIN PANEL ########## -->

{{--<script src="{{asset("public/lib/jquery/jquery-3.3.1.js")}}"></script>--}}
{{--<script async src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>--}}
{{--<script src="{{asset("public/lib/moment/moment.js")}}"></script>--}}

{{--<script src="{{asset("public/lib/popper.js/popper.js")}}"></script>--}}
{{--<script src="{{asset("public/lib/bootstrap/bootstrap.js")}}"></script>--}}
{{--<script src="{{asset("public/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js")}}"></script>--}}
<!--<script src="../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>-->
<!--<script src="../lib/moment/moment.js"></script>-->
<!--<script src="../lib/jquery-ui/jquery-ui.js"></script>-->

{{--<script src="{{asset("public/lib/jquery.sparkline.bower/jquery.sparkline.min.js")}}"></script>--}}
{{--<script src="{{asset("public/lib/d3/d3.js")}}"></script>--}}
{{--<script src="{{asset("public/lib/rickshaw/rickshaw.min.js")}}"></script>--}}


{{--<script src="{{asset("public/js/bracket.js")}}"></script>--}}
{{--<script src="{{asset("public/js/ResizeSensor.js")}}"></script>--}}


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>

<script src="{{asset('public/lib/jquery/jquery.js')}}"></script>
<script src="{{asset('public/lib/popper.js/popper.js')}}"></script>
<script src="{{asset('public/lib/bootstrap/bootstrap.js')}}"></script>
<script src="{{asset('public/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
<script src="{{asset('public/lib/moment/moment.js')}}"></script>
<script src="{{asset('public/lib/jquery-ui/jquery-ui.js')}}"></script>
<script src="{{asset('public/lib/jquery-switchbutton/jquery.switchButton.js')}}"></script>
<script src="{{asset('public/lib/peity/jquery.peity.js')}}"></script>
<script src="{{asset('public/lib/highlightjs/highlight.pack.js')}}"></script>
<script src="{{asset('public/lib/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('public/lib/jqvmap/maps/jquery.vmap.world.js')}}"></script>
<script src="{{asset('public/lib/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{asset('public/lib/jqvmap/maps/jquery.vmap.canada.js')}}"></script>

<script src="{{asset('public/js/bracket.js')}}"></script>
<script src="{{asset('public/js/jquery.vmap.sampledata.js')}}"></script>

<script>
    $(function(){
        "use strict";

        // FOR DEMO ONLY
        // menu collapsed by default during first page load or refresh with screen
        // having a size between 992px and 1299px. This is intended on this page only
        // for better viewing of widgets demo.
        $(window).resize(function(){
            minimizeMenu();
        });

        minimizeMenu();

        function minimizeMenu() {
            if(window.matchMedia("(min-width: 992px)").matches && window.matchMedia("(max-width: 1299px)").matches) {
                // show only the icons and hide left menu label by default
                $(".menu-item-label,.menu-item-arrow").addClass("op-lg-0-force d-lg-none");
                $("body").addClass("collapsed-menu");
                $(".show-sub + .br-menu-sub").slideUp();
            } else if(window.matchMedia("(min-width: 1300px)").matches && !$("body").hasClass("collapsed-menu")) {
                $(".menu-item-label,.menu-item-arrow").removeClass("op-lg-0-force d-lg-none");
                $("body").removeClass("collapsed-menu");
                $(".show-sub + .br-menu-sub").slideDown();
            }
        }
    });
</script>
@yield("script")
