<div class="scrollbar side-menu-bg">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                <a href="{{route('dashboard')}}"><div class="pull-left"><i class="ti-home"></i><span class="right-nav-text"></span>
                </div>{{ trans('main_trans.Dashboard') }}</a>
                
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Ekhtaberni Web Application</li>
        <!-- Grades-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                <div class="pull-left"><i class="fas fa-school"></i><span
                        class="right-nav-text">{{ trans('main_trans.Grades') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="elements" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('Grades.index')}}">{{ trans('main_trans.Grades_list') }}</a></li>
            </ul>
        </li>
        <!--Classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                <div class="pull-left"><i class="fa fa-building"></i><span
                        class="right-nav-text">{{ trans('main_trans.classes') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('Classes.index')}}">{{ trans('Classes.List_classes') }} </a> </li>
            </ul>
        </li>
        <!-- Section -->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                        class="right-nav-text">{{ trans('main_trans.sections') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('section.index')}}">{{ trans('Sections.List_Sections') }}</a></li>
            </ul>
        </li>
        <!-- students-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu"><i class="fas fa-user-graduate"></i>{{trans('main_trans.students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
            <ul id="students-menu" class="collapse">
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Student_information">{{trans('main_trans.Student_information')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                    <ul id="Student_information" class="collapse">
                        <li> <a href="{{route('Students.create')}}">{{trans('main_trans.Add_Student')}}</a></li>
                        <li> <a href="{{route('Students.index')}}">{{trans('main_trans.List_Students')}}</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Students_upgrade">{{trans('Students_trans.Students_Promotions')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                    <ul id="Students_upgrade" class="collapse">
                        <li> <a href="{{route('Promotion.index')}}">{{trans('Students_trans.add_Promotion')}}</a></li>
                        <li> <a href="{{route('Promotion.create')}}">{{trans('Students_trans.list_Promotions')}}</a> </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Graduate students">{{trans('Students_trans.Graduate_students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                    <ul id="Graduate students" class="collapse">
                        <li> <a href="{{route('Graduated.create')}}">{{trans('Students_trans.add_Graduate')}}</a> </li>
                        <li> <a href="{{route('Graduated.index')}}">{{trans('Students_trans.list_Graduate')}}</a> </li>
                    </ul>
                </li>
            </ul>
        </li>
        <!-- teacher -->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#teachers-menu">
                <div class="pull-left">
                    <span><i class="fas fa-chalkboard-teacher"></i></span>
                    <span class="right-nav-text">{{ trans('main_trans.teachers') }}</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="teachers-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('Teachers.index')}}">{{ trans('main_trans.List_Teachers') }}</a></li>
            </ul>
        </li>
        <!-- Parent -->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#parents-menu">
                <div class="pull-left">
                    <span><i class="fas fa-user-tie"></i></span>
                    <span class="right-nav-text">{{ trans('main_trans.parents') }}</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="parents-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{url('add_parent')}}">{{ trans('main_trans.List_Parents') }}</a></li>
            </ul>
        </li>
        <!-- Account -->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#accounts-menu">
                <div class="pull-left">
                    <span><i class="fas fa-money-bill-wave-alt"></i></span>
                    <span class="right-nav-text">{{ trans('main_trans.accounts') }}</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="accounts-menu" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{route('Fees.index')}}">{{trans('Fees.Fees_list')}}</a> </li>
            <li> <a href="{{route('Fees_Invoices.index')}}">{{trans('Fees.Fees')}}</a> </li>
            <li> <a href="{{route('receipt_students.index')}}">{{trans('receipt.receipts')}}</a> </li>
            <li> <a href="{{route('ProcessingFee.index')}}">{{trans('ProcessingFee.title')}}</a> </li>
            <li> <a href="{{route('Payment_students.index')}}"> {{ trans('payment.payment_vouchers') }}</a> </li>
            </ul>
        </li>
        <!-- Attendance -->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#attendance-menu">
                <div class="pull-left">
                    <span><i class="ti-check-box"></i></span>
                    <span class="right-nav-text">{{ trans('main_trans.attendance') }}</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="attendance-menu" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{route('Attendance.index')}}">{{trans('main_trans.List_Students')}}</a> </li>
            </ul>
        </li>
        <!-- Subjects-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
                <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">{{ trans('subjects.page_title') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('subjects.index')}}">{{ trans('subjects.list_page_title') }}</a> </li>
            </ul>
        </li>
        <!-- Exams -->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#exams-menu">
                <div class="pull-left">
                    <span><i class="ti-agenda"></i></span>
                    <span class="right-nav-text">{{ trans('main_trans.exams') }}</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="exams-menu" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{route('Quizzes.index')}}"> {{ trans('quizzes.list_page_title') }}</a> </li>
            <li> <a href="{{route('questions.index')}}">{{ trans('questions.questions_list') }}</a> </li>
            </ul>
        </li>
        <!-- Library -->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#library-menu">
                <div class="pull-left">
                    <span><i class="ti-book"></i></span>
                    <span class="right-nav-text">{{ trans('main_trans.library') }}</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="library-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('library.index')}}"> {{ trans('main_trans.List_library') }}</a></li>
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
        <!-- Setting  -->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#settings-menu">
                <div class="pull-left">
                    <span><i class="ti-settings"></i></span>
                    <span class="right-nav-text">{{ trans('main_trans.settings') }}</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="settings-menu" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{route('settings.index')}}">{{trans('main_trans.settings')}} </a></li>
            </ul>
        </li>
        <!-- User -->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#users-menu">
                <div class="pull-left">
                    <span><i class="ti-user"></i></span>
                    <span class="right-nav-text">{{ trans('main_trans.users') }}</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="users-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="calendar.html">Events Calendar</a></li>
            </ul>
        </li>

    </ul>
</div>
