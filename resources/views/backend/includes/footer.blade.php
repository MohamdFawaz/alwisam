<footer class="br-footer">
    <div class="footer-left">
        {{--<div class="mg-b-2">Copyright &copy; 2017. Bracket. All Rights Reserved.</div>--}}
        {{--<div>Attentively and carefully made by ThemePixels.</div>--}}
    </div>
    <div class="footer-right d-flex align-items-center">
    </div>
</footer>
<!-- ########## END: MAIN PANEL ########## -->


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
