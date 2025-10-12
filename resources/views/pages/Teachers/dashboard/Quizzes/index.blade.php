@extends('layouts.master')
@section('css')
@endsection
@section('title')
    قائمة الاختبارات
@stop

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        قائمة الاختبارات
    @stop
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('quizzes.create')}}" 
                                   class="btn btn-success btn-sm" role="button">
                                   اضافة اختبار جديد
                                </a><br><br>

                                <div class="table-responsive">
                                    <table id="datatable" 
                                           class="table table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>اسم الاختبار</th>
                                                <th>اسم المعلم</th>
                                                <th>المرحلة الدراسية</th>
                                                <th>الصف الدراسي</th>
                                                <th>القسم</th>
                                                <th>العمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($quizzes as $quizze)
                                                <tr>
                                                    <td>{{ $loop->iteration}}</td>
                                                    <td>{{$quizze->name}}</td>
                                                    <td>{{$quizze->teacher->Name}}</td>
                                                    <td>{{$quizze->grade->Name}}</td>
                                                    <td>{{$quizze->classroom->Name_Class}}</td>
                                                    <td>{{$quizze->section->Name_Section}}</td>
                                                    <td>
                                                        <a href="{{route('quizzes.edit',$quizze->id)}}"
                                                           class="btn btn-info btn-sm" title="تعديل">
                                                           <i class="fa fa-edit"></i>
                                                        </a>

                                                        <button type="button" 
                                                                class="btn btn-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#delete_exam{{ $quizze->id }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>

                                                        <a href="{{route('quizzes.show',$quizze->id)}}"
                                                           class="btn btn-warning btn-sm" title="عرض الاسئلة">
                                                           <i class="fa fa-binoculars"></i>
                                                        </a>

                                                        <a href="{{route('student.quizze',$quizze->id)}}"
                                                           class="btn btn-primary btn-sm" title="عرض الطلاب المختبرين">
                                                           <i class="fa fa-street-view"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <!-- delete modal -->
                                                <div class="modal fade" id="delete_exam{{$quizze->id}}" tabindex="-1"
                                                     role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <form action="{{route('quizzes.destroy',$quizze->id)}}" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">حذف اختبار</h5>
                                                                    <button type="button" class="close" data-dismiss="modal">
                                                                        <span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>هل أنت متأكد من حذف الاختبار: {{$quizze->name}} ؟</p>
                                                                    <input type="hidden" name="id" value="{{$quizze->id}}">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                                    <button type="submit" class="btn btn-danger">حذف</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('js')
@endsection
