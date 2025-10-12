@extends('layouts.master')
@section('css')
<!-- Include repeater CSS -->
<style>
    .repeater-item {
        border: 1px solid #e0e0e0;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 10px;
        background: linear-gradient(135deg, #ffffff, #f9f9f9);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }


    .btn-remove-item {
        margin-top: 15px;
        transition: background-color 0.2s ease;
    }

    .btn-remove-item:hover {
        background-color: #dc3545;
        color: white;
    }

    .form-repeater-container {
        margin-top: 30px;
    }

    .btn[data-repeater-create] {
        transition: background-color 0.2s ease;
    }

    .btn[data-repeater-create]:hover {
        background-color: #28a745;
        color: white;
    }

    label {
        font-weight: 600;
        color: #333;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ced4da;
        transition: border-color 0.2s;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }

    .modal-content {
        border-radius: 15px;
    }

    .modal-header {
        background-color: #007bff;
        color: white;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .modal-footer {
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }
</style>

@section('title')
    {{ trans('main_trans.classes') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="breadcrumb-item active">{{ trans('main_trans.classes') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{ trans('main_trans.classes') }}</li>
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
                
                <button type="button" class="button x-small" style="margin-bottom: 20px" data-toggle="modal" data-target="#addClassesModal">
                    {{ trans('Classes.add_Class') }}
                </button>
                
                <!-- Delete Selected UI -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <button id="btn_delete_all" class="btn btn-danger" type="button">{{ trans('Classes.Delete_Selected') }}</button>
                    </div>
                </div>
                        <div class="table-responsive">
                                                                <table id="datatable" class="table table-striped table-bordered p-0">
                                                                    <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="example-select-all" name="select_all" onclick="CheckAll('box1' , this)"></th>
                                                    <th>#</th>
                                                    <th>{{ trans('Classes.Name') }}</th>
                                                    <th>{{ trans('Classes.Grade') }}</th>
                                                    <th>{{ trans('Classes.Processes') }}</th>
                                                </tr>
                                            </thead>
                                                                    <tbody>
                                                                        @foreach ($Classes ?? [] as $class)
                                                <tr>
                                                    <td><input type="checkbox" class="box1" value="{{ $class->id }}"></td>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td class="class-name-cell">{{$class->Name_Classe ?? 'N/A'}}</td>
                                                    <td>{{$class->Grade->Name ?? 'N/A'}}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $class->id}}" title="{{trans('Classes.Edit')}}"><i class="fa fa-edit"></i></button>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $class->id}}" title="{{trans('Classes.Delete')}}"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                                            <!-- Edit Modal for each class -->
                                                                            <div class="modal fade" id="edit{{ $class->id ?? '' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                                                                                                {{ trans('Classes.edit_classes') }}
                                                                                            </h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('Classes.Close') }}">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <form action="{{ route('Classes.update', $class->id ?? '') }}" method="POST">
                                                                                                @csrf
                                                                                                @method('PUT')
                                                                                                <div class="row">
                                                                                                    <div class="col">
                                                                                                        <label for="Name" class="mr-sm-2">{{ trans('Classes.stage_name_ar') }}</label>
                                                                                                        <input type="text" name="name" class="form-control" value="{{ $class->getTranslation('Name_Classe', 'ar') ?? '' }}">
                                                                                                    </div>
                                                                                                    <div class="col">
                                                                                                        <label for="Name_en" class="mr-sm-2">{{ trans('Classes.stage_name_en') }}</label>
                                                                                                        <input type="text" name="name_en" class="form-control" value="{{ $class->getTranslation('Name_Classe', 'en') ?? '' }}">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="grade_id">{{ trans('Classes.Grade') }}</label>
                                                                                                    <select name="grade_id" class="form-control">
                                                                                                        @foreach($Grades ?? [] as $grade)
                                                                                                            <option value="{{ $grade->id }}" {{ ($class->grade_id ?? '') == $grade->id ? 'selected' : '' }}>
                                                                                                                {{ $grade->Name }}
                                                                                                            </option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="modal-footer">
                                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                                                        {{ trans('Classes.Close') }}
                                                                                                    </button>
                                                                                                    <button type="submit" class="btn btn-success">
                                                                                                        {{ trans('Classes.submit') }}
                                                                                                    </button>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <!-- Delete Modal for each class -->
                                                                            <div class="modal fade" id="delete{{ $class->id ?? '' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="exampleModalLabel">{{ trans('Classes.delete_classes') }}</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            {{ trans('Classes.Warning_classes') }}
                                                                                            <form action="{{ route('Classes.destroy', $class->id ?? '') }}" method="POST">
                                                                                                @csrf
                                                                                                @method('Delete')
                                                                                                <div class="modal-footer">
                                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                                                        {{ trans('Classes.Close') }}
                                                                                                    </button>
                                                                                                    <button type="submit" class="btn btn-danger">
                                                                                                        {{ trans('Classes.Delete') }}
                                                                                                    </button>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                        </div>
            </div>
        </div>
    </div>
        <!-- Add Classes Modal with Form Repeater -->
        <div class="modal fade" id="addClassesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                            {{ trans('Classes.add_Class') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('Classes.store') }}" method="POST" id="classesForm">
                            @csrf
                            <div class="repeater">
                                <div data-repeater-list="List_Classes">
                                    <div data-repeater-item class="repeater-item">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="name" class="mr-sm-2">{{ trans('Classes.stage_name_ar') }}</label>
                                                <input type="text" name="name" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="name_en" class="mr-sm-2">{{ trans('Classes.stage_name_en') }}</label>
                                                <input type="text" name="name_classe_en" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <select name="grade_id" class="form-control" required>
                                                    @foreach($Grades ?? [] as $grade)
                                                        <option value="{{ $grade->id }}">{{ $grade->Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <button type="button" class="btn btn-danger btn-sm btn-remove-item" data-repeater-delete>
                                                    <i class="fa fa-trash"></i> {{ trans('Classes.Delete') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-success" data-repeater-create>
                                            <i class="fa fa-plus"></i> {{ trans('Classes.add_Class') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    {{ trans('Classes.Close') }}
                                </button>
                                <button type="submit" class="btn btn-success">
                                    {{ trans('Classes.submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            <!-- Delete Modal for set class -->
        <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ trans('Classes.delete_Classes') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ trans('Classes.Warning_classes') }}
                        <form action="{{ route('Classes.destroy_all') }}" method="POST">
                            @csrf
                            @method('Delete')
                            <input type="hidden" class="text" name="delete_all_id" id="delete_all_id" value="">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    {{ trans('Classes.Close') }}
                                </button>
                                <button type="submit" class="btn btn-danger">
                                    {{ trans('Classes.Delete') }}
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
<script>
function CheckAll(classname , elem)
{
    var elements = document.getElementsByClassName(classname);
    if(elem.checked == true )
    {
        for (var i = 0; i < elements.length; i++) {
            elements[i].checked = elem.checked;
        }
    }
    else
    {
        for (var i = 0; i < elements.length; i++) {
            elements[i].checked = false;
        }
    }
}
$(function()
{
    $('#btn_delete_all').on('click', function()
    {
        var selected = new Array();
        $('#datatable input[type="checkbox"]:checked').each(function()
        {
            selected.push($(this).val());
        });
        if(selected.length > 0)
        {
            $('#delete_all').modal('show');
            $('input[id="delete_all_id"]').val(selected);
        }
    });
});
</script>
@endsection
