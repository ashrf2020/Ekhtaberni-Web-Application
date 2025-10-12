<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ route('dashboard.student') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{ trans('main_trans.Dashboard') }}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Ekhtaberni Web Application</li>


        <!-- الامتحانات-->
        <li>
            <a href="{{ route('student.exams.index') }}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{ trans('main_trans.exams') }}</span></a>
        </li>

        <!-- الحصص الدراسية -->
        <li>
            <a href="{{ route('student.sessions.index') }}"><i class="fas fa-video"></i><span
                    class="right-nav-text">{{ trans('main_trans.my_sessions') }}</span></a>
        </li>

        <!-- الملف الشخصي-->
        <li>
            <a href="{{ route('profile.edit') }}" target="_blank"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{ trans('main_trans.profile') }}</span></a>
        </li>

    </ul>
</div>
