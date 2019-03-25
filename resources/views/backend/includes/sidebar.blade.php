<!-- ########## START: LEFT PANEL ########## -->
<div class="br-logo"><a href="{{route('backend.dashboard')}}"><span>[</span><img src="{{asset('public/images/icon/grand-black-hori-logo.png')}}" alt="grand-logo" style="max-width: 170px"><span>]</span></a></div>
<div class="br-sideleft overflow-y-auto">
    <label class="sidebar-label pd-x-15 mg-t-20">{{trans('admin.sidebar.navigation')}}</label>
    <div class="br-sideleft-menu">
        <a href="{{route('backend.dashboard')}}" class="br-menu-link @if(Request::segment(2)== "home") active @endif">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">{{trans('admin.sidebar.dashboard')}}</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <a href="{{route('backend.category')}}" class="br-menu-link @if(Request::segment(2)== "category") active @endif ">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-grid-view-outline tx-24"></i>
                <span class="menu-item-label">{{trans('admin.sidebar.categories')}}</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <a href="{{route('backend.exam-type')}}" class="br-menu-link @if(Request::segment(2)== "exam-type") active @endif">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
                <span class="menu-item-label">{{trans('admin.sidebar.exam_types')}}</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <a href="{{route('backend.exam')}}" class="br-menu-link @if(Request::segment(2)== "exam") active @endif">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-paper-outline tx-20"></i>
                <span class="menu-item-label">{{trans('admin.sidebar.exams')}}</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <a href="{{route('backend.questions')}}" class="br-menu-link @if(Request::segment(2)== "questions") active @endif">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-compose-outline tx-20"></i>
                <span class="menu-item-label">{{trans('admin.sidebar.questions')}}</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
    </div><!-- br-sideleft-menu -->

    <br>
</div><!-- br-sideleft -->
<!-- ########## END: LEFT PANEL ########## -->