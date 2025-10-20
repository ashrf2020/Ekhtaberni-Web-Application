@extends('layouts.master')
@section('css')
@section('title')
    {{trans('quizzes.list_page_title')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('quizzes.list_page_title')}}
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
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                            data-page-length="50"
                                            style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('quizzes.subject')}}</th>
                                            <th>{{trans('quizzes.quizze_name')}}</th>
                                            <th>{{trans('quizzes.enter_or_grade')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizzes as $quizze)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$quizze->subject->name}}</td>
                                                <td>{{$quizze->name}}</td>
                                                <td>
                                                    @php
                                                        $studentDegree = $quizze->degrees->where('student_id', auth('student')->id())->first();
                                                    @endphp
                                                    @if($studentDegree)
                                                        {{ $studentDegree->score }}
                                                    @else
                                                        <a href="{{ route('student.exams.show', $quizze->id) }}" onclick="alertAbuse()"
                                                            class="btn btn-outline-success btn-sm" role="button"
                                                            aria-pressed="true">
                                                            <i class="fas fa-person-booth"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
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
<script>
    function alertAbuse() {
        alert("برجاء عدم إعادة تحميل الصفحة بعد دخول الاختبار - في حال تم تنفيذ ذلك سيتم الغاء الاختبار بشكل اوتوماتيك ");
    }
</script>
@endsection
