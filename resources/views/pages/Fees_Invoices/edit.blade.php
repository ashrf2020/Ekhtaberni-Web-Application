@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('Fees_Invoices.edit_invoice') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Fees_Invoices.edit_invoice') }}
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

                    <form action="{{route('Fees_Invoices.update','test')}}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">{{ trans('Fees_Invoices.student_name') }}</label>
                                <input type="text" value="{{$fee_invoices->student->name}}" readonly name="title_ar" class="form-control">
                                <input type="hidden" value="{{$fee_invoices->id}}" name="id" class="form-control">
                            </div>


                            <div class="form-group col">
                                <label for="inputEmail4">{{ trans('Fees_Invoices.amount') }}</label>
                                <input type="number" value="{{$fee_invoices->amount}}" name="amount" class="form-control">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputZip">{{ trans('Fees_Invoices.fee_type') }}</label>
                                <select class="custom-select mr-sm-2" name="fee_id">
                                    @foreach($fees as $fee)
                                        <option value="{{$fee->id}}" {{$fee->id == $fee_invoices->fee_id ? 'selected':"" }}>{{$fee->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="inputAddress">{{ trans('Fees_Invoices.notes') }}</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4">{{$fee_invoices->description}}</textarea>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">{{ trans('Fees_Invoices.confirm') }}</button>

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
