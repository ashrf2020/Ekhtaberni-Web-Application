@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('Fees_Invoices.page_title') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Fees_Invoices.page_title') }}
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
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{ trans('Fees_Invoices.student_name') }}</th>
                                            <th>{{ trans('Fees_Invoices.fee_type') }}</th>
                                            <th>{{ trans('Fees_Invoices.amount') }}</th>
                                            <th>{{ trans('Fees_Invoices.grade') }}</th>
                                            <th>{{ trans('Fees_Invoices.classroom') }}</th>
                                            <th>{{ trans('Fees_Invoices.description') }}</th>
                                            <th>{{ trans('Fees_Invoices.actions') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($Fee_invoices as $Fee_invoice)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $Fee_invoice->student ? $Fee_invoice->student->name : 'N/A' }}</td>
                                            <td>{{ $Fee_invoice->fees ? $Fee_invoice->fees->title : 'N/A' }}</td>
                                            <td>{{ number_format($Fee_invoice->amount, 2) }}</td>
                                            <td>{{ $Fee_invoice->grade ? $Fee_invoice->grade->Name : 'N/A' }}</td>
                                            <td>{{ $Fee_invoice->classroom ? $Fee_invoice->classroom->Name_Classe : 'N/A' }}</td>
                                            <td>{{$Fee_invoice->description}}</td>
                                                <td>
                                                    <a href="{{route('Fees_Invoices.edit',$Fee_invoice->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="{{ trans('Fees_Invoices.edit') }}"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Fee_invoice{{$Fee_invoice->id}}" title="{{ trans('Fees_Invoices.delete') }}"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('pages.Fees_Invoices.Delete')
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
