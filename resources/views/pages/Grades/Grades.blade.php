@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('main_trans.Grades') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="breadcrumb-item active">{{ trans('main_trans.Grades') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{ trans('main_trans.Grades') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100"> 
            <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button type="button" class="button x-small" style="margin-bottom: 20px" data-toggle="modal" data-target="#exampleModal">
                {{ trans('Grades.add_Grade') }}
            </button>
                <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered p-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('Grades.Name') }}</th>
                        <th>{{ trans('Grades.Notes') }}</th>
                        <th>{{ trans('Grades.Processes') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grades as $grade)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$grade->Name}}</td>
                            <td>{{$grade->Notes}}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $grade->id }}" title="{{trans('Grades.Edit')}}"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $grade->id }}" title="{{trans('Grades.Delete')}}"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        <!-- edit_model_grades -->
                        <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                                            {{ trans('Grades.Edit') }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('Grades.Close') }}">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="{{ route('Grades.update', $grade->id) }}" method="POST">
                                            @csrf
                                            @method('PUT') <!-- مهم لتحديد أنها عملية تعديل -->

                                            <div class="row">
                                                <div class="col">
                                                    <label for="Name" class="mr-sm-2">{{ trans('Grades.stage_name_ar') }}</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $grade->getTranslation('Name', 'ar') }}">
                                                </div>

                                                <div class="col">
                                                    <label for="Name_en" class="mr-sm-2">{{ trans('Grades.stage_name_en') }}</label>
                                                    <input type="text" name="name_en" class="form-control" value="{{ $grade->getTranslation('Name', 'en') }}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="notes">{{ trans('Grades.Notes') }}</label>
                                                <textarea class="form-control" name="notes" rows="3">{{ $grade->Notes }}</textarea>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    {{ trans('Grades.Close') }}
                                                </button>
                                                <button type="submit" class="btn btn-success">
                                                    {{ trans('Grades.submit') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- delete_model_grades --}}
                        <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ trans('Grades.delete_Grade') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                                {{ trans('Grades.Warning_Grade') }}
                                <form action="{{ route('Grades.destroy', $grade->id) }}" method="POST">
                                    @csrf
                                    @method('Delete') <!-- مهم لتحديد أنها عملية تعديل -->
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        {{ trans('Grades.Close') }}
                                    </button>
                                    <button type="submit" class="btn btn-danger">
                                        {{ trans('Grades.Delete') }}
                                    </button>
                            </div>
                            </form>
                            </div>

                            </div>
                        </div>
                        </div>
                    @endforeach
                </table>
            </div>
            </div>
            </div>
        </div>
            {{-- add_model_grades --}}
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                                {{ trans('Grades.add_Grade') }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{-- form --}}
                            <form action="{{ route('Grades.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <label for="Name" class="mr-sm-2">{{ trans('Grades.stage_name_ar') }}</label>
                                        <input type="text" id="Name" name="name" class="form-control">
                                    </div>
                                    <div class="col">
                                        <label for="Name-en" class="mr-sm-2">{{ trans('Grades.stage_name_en') }}</label>
                                        <input type="text" id="Name-en" name="name_en" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">{{ trans('Grades.Notes') }}</label>
                                    <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        {{ trans('Grades.Close') }}
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        {{ trans('Grades.submit') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div> 
<!-- row closed -->
@endsection
@section('js')

@endsection
