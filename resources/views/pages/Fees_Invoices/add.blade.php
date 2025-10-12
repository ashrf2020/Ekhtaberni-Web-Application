@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('Fees_Invoices.add_page_title') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{ trans('Fees_Invoices.add_page_title') }} {{$student->name}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
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

                        <form class=" row mb-30" action="{{ route('Fees_Invoices.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="repeater">
                                    <div data-repeater-list="List_Fees">
                                        <div data-repeater-item>
                                            <div class="row">

                                                <div class="col">
                                                    <label for="Name" class="mr-sm-2">{{ trans('Fees_Invoices.student_name') }}</label>
                                                    <select class="fancyselect" name="student_id" required>
                                                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="Name_en" class="mr-sm-2">{{ trans('Fees_Invoices.fee_type') }}</label>
                                                    <div class="box">
                                                        @if($fees->isNotEmpty())
                                                            <select class="fancyselect" name="fee_id" required>
                                                                <option value="">{{ trans('Fees_Invoices.select_fee') }}</option>
                                                                @foreach($fees as $fee)
                                                                    <option value="{{ $fee->id }}" data-amount="{{ $fee->amount }}">{{ $fee->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            <div class="alert alert-danger">
                                                                {{ trans('Fees_Invoices.no_fees_available') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label for="amount" class="mr-sm-2">{{ trans('Fees_Invoices.amount') }}</label>
                                                    <div class="box">
                                                        <input type="text" class="form-control" id="amount" name="amount" readonly required>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label for="description" class="mr-sm-2">{{ trans('Fees_Invoices.description') }}</label>
                                                    <div class="box">
                                                        <input type="text" class="form-control" name="description" required>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label for="Name_en" class="mr-sm-2">{{trans('Students_trans.Processes')}}:</label>
                                                    <input class="btn btn-danger btn-block" data-repeater-delete type="button" value="{{ trans('Fees_Invoices.delete_row') }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-12">
                                            <input class="button" data-repeater-create type="button" value="{{ trans('Fees_Invoices.add_row') }}"/>
                                        </div>
                                    </div><br>
                                    <input type="hidden" name="Grade_id" value="{{$student->Grade_id}}">
                                    <input type="hidden" name="Classroom_id" value="{{$student->class_id}}">

                                    <button type="submit" class="btn btn-primary">{{ trans('Fees_Invoices.confirm_data') }}</button>
                                </div>
                            </div>
                        </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
<script>
    $(document).ready(function() {
        // Handle fee selection change for both existing and dynamically added rows
        $(document).on('change', 'select[name^="List_Fees["][name$="[fee_id]"]', function() {
            var $row = $(this).closest('[data-repeater-item]');
            var selectedOption = $(this).find('option:selected');
            var amount = selectedOption.data('amount');
            
            // Find the amount input within the same row
            var $amountInput = $row.find('input[name$="[amount]"]');
            
            if (amount) {
                $amountInput.val(amount);
            } else {
                $amountInput.val('');
            }
        });

        // Initialize amounts for existing rows with old input
        @if(old('List_Fees'))
            @foreach(old('List_Fees') as $index => $fee)
                @if(isset($fee['fee_id']))
                    var $row = $('[data-repeater-list="List_Fees"] [data-repeater-item]:eq({{ $index }})');
                    var selectedOption = $row.find('select[name$="[fee_id]"] option[value="{{ $fee['fee_id'] }}"]');
                    if (selectedOption.length) {
                        $row.find('input[name$="[amount]"]').val(selectedOption.data('amount'));
                    }
                @endif
            @endforeach
        @endif
    });
</script>
@endsection
