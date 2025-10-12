@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('quizzes.list_page_title') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('quizzes.list_page_title') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('Quizzes.create')}}" class="btn btn-success btn-sm" role="button"
                                    aria-pressed="true">{{ trans('quizzes.add_quiz') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                            data-page-length="50"
                                            style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('quizzes.quiz_name_ar') }}</th>
                                            <th>{{ trans('quizzes.teacher') }}</th>
                                            <th>{{ trans('quizzes.grade') }}</th>
                                            <th>{{ trans('quizzes.classroom') }}</th>
                                            <th>{{ trans('quizzes.section') }}</th>
                                            <th>{{ trans('quizzes.actions') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizzes as $quizze)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$quizze->name}}</td>
                                                <td>{{$quizze->teacher->Name ?? ""}}</td>
                                                <td>{{$quizze->grade->Name}}</td>
                                                <td>{{$quizze->classroom->Name_Classe}}</td>
                                                <td>{{$quizze->section->Name_Section}}</td>
                                                <td>
                                                    <a href="{{route('Quizzes.edit',$quizze->id)}}"
                                                        class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                            class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#delete_exam{{ $quizze->id }}" title="حذف"><i
                                                            class="fa fa-trash"></i></button>
                                                    <a href="{{route('Quizzes.show',$quizze->id)}}"
                                                            class="btn btn-warning btn-sm" title="عرض الأسئلة" role="button" aria-pressed="true"><i
                                                            class="fa fa-binoculars"></i></a>
                                                    <a href="{{route('student.quizze',$quizze->id)}}"
                                                            class="btn btn-primary btn-sm" title="عرض الطلاب المختبرين">
                                                            <i class="fa fa-street-view"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="delete_exam{{$quizze->id}}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('Quizzes.destroy','test')}}" method="post">
                                                        {{method_field('delete')}}
                                                        {{csrf_field()}}
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                                    class="modal-title" id="exampleModalLabel">{{ trans('quizzes.delete_confirm') }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>{{ trans('quizzes.delete_confirm') }} {{$quizze->name}}؟</p>
                                                                <p class="text-danger">{{ trans('quizzes.Warning_Grade') }}</p>
                                                                <input type="hidden" name="id" value="{{$quizze->id}}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ trans('quizzes.close') }}</button>
                                                                    <button type="submit"
                                                                            class="btn btn-danger">{{ trans('quizzes.delete') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
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
