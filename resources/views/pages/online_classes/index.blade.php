@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('online_classes.online_classes') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('online_classes.online_classes') }}
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
                                <a href="{{route('online_classes.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{ trans('online_classes.add_new_class') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{ trans('online_classes.grade') }}</th>
                                            <th>{{ trans('online_classes.class') }}</th>
                                            <th>{{ trans('online_classes.section') }}</th>
                                            <th>{{ trans('online_classes.teacher') }}</th>
                                            <th>{{ trans('online_classes.class_title') }}</th>
                                            <th>{{ trans('online_classes.start_date') }}</th>
                                            <th>{{ trans('online_classes.class_time') }}</th>
                                            <th>{{ trans('online_classes.meeting_link') }}</th>
                                            <th>{{ trans('online_classes.actions') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($online_classes as $online_classe)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$online_classe->grade->Name}}</td>
                                            <td>{{ $online_classe->classroom->Name_Classe }}</td>
                                            <td>{{$online_classe->section->Name_Section}}</td>
                                                <td>{{ optional($online_classe->user)->name ?? '-' }}</td>
                                                <td>{{$online_classe->topic}}</td>
                                                <td>{{$online_classe->start_at}}</td>
                                                <td>{{$online_classe->duration}}</td>
                                                <td class="text-danger"><a href="{{$online_classe->join_url}}" target="_blank">{{ trans('online_classes.join_now') }}</a></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_receipt{{$online_classe->meeting_id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('pages.online_classes.delete')
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
