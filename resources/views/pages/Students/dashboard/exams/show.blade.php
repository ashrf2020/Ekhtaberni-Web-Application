@extends('layouts.master')
@section('css')
@section('title')
    اجراء اختبار
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    اجراء اختبار 
@stop
    <!-- breadcrumb -->
@endsection
@section('content')

    @livewire('show-question', ['quizze_id' => $quizze_id, 'student_id' => $student_id])

@endsection
@section('js')
@endsection

