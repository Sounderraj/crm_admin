@extends('layouts.master')
@section('title') @lang('translation.products') @endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') <a href="{{ route('product.index') }}">Products</a> @endslot
        @slot('title') Add @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Product</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row">

                            <form action="{{ route('product.store') }}" method="post" class="needs-validation" novalidate>
                            @csrf
                                <div class="row mb-3">
                                    <label for="type" class="form-label col-sm-2 pt-0">Type</label>
                                    <div class="col-sm-10">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="type_b" value="Goods">
                                            <label class="form-check-label" for="type_b">Goods</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="type_i" value="Service">
                                            <label class="form-check-label" for="type_i">Service</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6 form-group">
                                        <label for="name">Product Name</label> <span class="text-danger">*</span>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Product Name" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>SKU </label>
                                        <input type="text" name="sku_number" id="sku_number" class="form-control" placeholder="SKU">
                                    </div>
                                </div>

                                <div class="row mb-3">                                    
                                    <div class="col-sm-6 form-group">
                                        <label>HSN Code</label>
                                        <input type="text" name="hsn_code" id="hsn_code" class="form-control" placeholder="HSN Code">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>SAC Code</label>
                                        <input type="text" name="sac_code" id="sac_code" class="form-control" placeholder="SAC Code">
                                    </div>
                                </div>

                                <div class="row mb-3">                                    
                                    <div class="col-sm-6 form-group">
                                        <label>Unit</label>
                                        <input type="text" name="unit" id="unit" class="form-control" placeholder="Unit">
                                    </div>
                                </div>

                                <div class="row mb-4">                                    
                                    <div class="col-sm-6 form-group">
                                        <label>Tax Preference</label> <span class="text-danger">*</span>
                                        <select name="tax_preference" id="tax_preference" class="form-control js-example-basic-single select2-hidden-accessible" required onchange="toggleTaxPrefFields()">
                                            @php
                                                $tax_prefArr = \App\Models\Product::getTaxPreferenceEnumValues();
                                            @endphp
                                            <!-- <option value="" >Select GST Treatment of customer</option> -->
                                            @foreach($tax_prefArr as $val)
                                                <option value="{{ $val }}">{{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-5 tax_rate_select_div">                                    
                                    <div class="col-sm-6 form-group">
                                        <label>Intra Tax Rate</label> <span class="text-danger">*</span>
                                        <select name="intra_tax_rate_id" id="intra_tax_rate_id" class="form-control js-example-basic-single select2-hidden-accessible" required>
                                            @php
                                                $sid = $taxrates_default->intra_tax_rate_id ?? '';
                                            @endphp
                                            @foreach($taxrates as $val)
                                                <option value="{{ $val->id }}" {{ $sid==$val->id ? 'selected':'' }}>{{ $val->tax_name ." [". $val->tax_rate_percentage ."%]" }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6 form-group tax_rate_select_div">
                                        <label>Inter Tax Rate</label> <span class="text-danger">*</span>
                                        <select name="inter_tax_rate_id" id="inter_tax_rate_id" class="form-control js-example-basic-single select2-hidden-accessible" required>
                                            @php
                                                $sid = $taxrates_default->inter_tax_rate_id ?? '';
                                            @endphp
                                            @foreach($taxrates as $val)
                                                <option value="{{ $val->id }}" {{ $sid==$val->id ? 'selected':'' }}>{{ $val->tax_name ." [". $val->tax_rate_percentage ."%]" }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-5">
                                    <label class="form-label col-sm-2 pt-0">Sales Information</label>
                                    <div class="col-sm-2 form-group">
                                        <label>Account</label>
                                        <input type="text" name="" disabled class="form-control" placeholder="Sale" value="Sale">
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>Selling Price</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">{{$default_currency->code ?? ''}}</span>
                                            <input type="hidden" name="currency" value="{{$default_currency->code ?? ''}}">
                                            <input type="text" name="selling_price" id="selling_price" class="form-control" placeholder="Selling Price" aria-label="Selling Price" aria-describedby="basic-addon2" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>Description</label>
                                        <textarea name="s_desc" id="s_desc" class="form-control" rows="2" placeholder="Description"></textarea>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="form-label col-sm-2 pt-0">Purchase Information</label>
                                    <div class="col-sm-2 form-group">
                                        <label>Account</label>
                                        <input type="text" name="" disabled class="form-control" placeholder="Purchase" value="Purchase">
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>Cost Price</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">{{$default_currency->code ?? ''}}</span>
                                            <input type="text" name="cost_price" id="cost_price" class="form-control" placeholder="Cost Price" aria-label="Cost Price" aria-describedby="basic-addon1" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>Description</label>
                                        <textarea name="p_desc" id="p_desc" class="form-control" rows="2" placeholder="Description"></textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">                                    
                                    <div class="col-sm-6 form-group">
                                        <div class="form-check form-switch form-switch-md" dir="ltr">
                                            <input type="checkbox" class="form-check-input" id="track_inventry" name="track_inventry">
                                            <label class="form-check-label" for="track_inventry">Track Inventory for this item</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-5 inventory_select_div">                                    
                                    <div class="col-sm-6 form-group">
                                        <label>Stock In Hand</label>
                                        <input type="text" name="stock_in_hand" id="stock_in_hand" class="form-control" placeholder="Stock in hand">
                                    </div>
                                </div>

                                <br>
                                <div class="col-sm-6 mt-3 gap-4 text-end">
                                    <button type="button" class="btn btn-light mx-3">
                                        <a href="{{ route('product.index') }}">Cancel</a>
                                    </button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

@endsection
@section('script')
<script src="{{ URL::asset('build/js/pages/form-validation.init.js') }}"></script>
<!--jquery cdn-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
    
<script>
    function toggleTaxPrefFields() {
        var tax_preference = document.getElementById("tax_preference").value;
        var intra_tax_rate_id = document.getElementById("intra_tax_rate_id");
        var inter_tax_rate_id = document.getElementById("inter_tax_rate_id");

        if (tax_preference == 'Taxable') {
            $(".tax_rate_select_div").show();
            intra_tax_rate_id.required = true;
            inter_tax_rate_id.required = true;
        } else {
            $(".tax_rate_select_div").hide();
            intra_tax_rate_id.required = false;
            inter_tax_rate_id.required = false;
        }
    }
    $(".tax_rate_select_div").show();

    // $('.inventory_select_div').hide();
    $('#track_inventry').change(function () {
    if (this.checked) {
        $('.inventory_select_div').show();
        $('#stock_in_hand').prop('required', true);
    } else {
        $('.inventory_select_div').hide();
        $('#stock_in_hand').prop('required', false);
    }
    });
    $('#track_inventry').trigger('change');
</script>
@endsection
