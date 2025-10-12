<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/teacher/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Ekhtaberni Web Application</li>
        <!-- الاقسام-->
        <li>
            <a href="{{route('teacher.sections')}}"target="_blank"><i class="fas fa-chalkboard"></i><span
                    class="right-nav-text">{{ trans('main_trans.sections') }}</span></a>
        </li>
        <!-- الطلاب-->
        <li>
            <a href="{{route('students.index')}}" target="_blank"><i class="fas fa-user-graduate"></i><span
                    class="right-nav-text">{{ trans('main_trans.students') }}</span></a>
        </li>
        <!-- الامتحانات-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#exams-menu"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{ trans('main_trans.exams') }}</span>
                    <div class="pull-right"><i class="ti-plus"></i></div>
                    <div class="clearfix"></div>
                </a>
            <ul id="exams-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('Quizzes.index')}}" target="_blank"> {{ trans('quizzes.list_page_title') }}</a> </li>
                <li> <a href="{{route('questions.index')}}" target="_blank">{{ trans('questions.questions_list') }}</a> </li>
            </ul>
        </li>
        <!-- Online_Classes -->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#online_classes-menu">
                <div class="pull-left">
                    <span><i class="ti-video-camera"></i></span>
                    <span class="right-nav-text">{{ trans('main_trans.online_classes') }}</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="online_classes-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('online_classes.index')}}">{{ trans('online_classes.Online_classes_with_Zoom') }}</a> </li>
            </ul>
        </li>
        <!-- التقارير-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                        class="right-nav-text">{{trans('Students_trans.report')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('attendance.report')}}">{{trans('Students_trans.attendance_report')}}</a></li>
                <li><a href="#">{{trans('Students_trans.exam_report')}}</a></li>
            </ul>
        </li>
        <!-- الملف الشخصي-->
        <li>
            <a href="{{ route('profile.edit') }}"target="_blank"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{ trans('main_trans.profile') }}</span></a>
        </li>

    </ul>
</div>
