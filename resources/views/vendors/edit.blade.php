@extends('layouts.master')
@section('title') @lang('translation.vendors') @endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
    @slot('li_1') <a href="{{ route('vendors.index') }}">@lang('translation.vendors')</a> @endslot
    @slot('title') Edit @endslot
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
                <h4 class="card-title mb-0 flex-grow-1">Edit Vendor</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    <div class="row">
                    <form action="{{ route('vendors.update', $user->id) }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="row mb-4">
                                <label for="vendor_type" class="form-label col-sm-2 pt-0">Vendor Type <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="vendor_type" required id="vendor_type_b" value="Business" {{ $user->vendor_type == 'Business' ? 'checked' : ''}}>
                                        <label class="form-check-label" for="vendor_type_b">Business</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="vendor_type" required id="vendor_type_i" value="Individual" {{ $user->vendor_type == 'Individual' ? 'checked': ''}}>
                                        <label class="form-check-label" for="vendor_type_i">Individual</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="vendor_type" class="form-label col-sm-2 pt-0">Vendor Name <span class="text-danger">*</span></label>
                                <div class="col-sm-1 mb-1">
                                    @php
                                        $salutationValues = \App\Models\Vendor::getSalutationEnumValues();
                                    @endphp
                                    <select name="salutation" id="salutation" class="form-control js-example-basic-single select2-hidden-accessible" required>
                                        @foreach($salutationValues as $val)
                                            <option value="{{ $val }}">{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-4 mb-1">
                                    <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control" value="{{ $user->first_name }}" required>
                                </div>
                                <div class="col-sm-3 mb-1">
                                    <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control" value="{{ $user->last_name }}" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label class="form-label col-sm-2 pt-0">Vendor Display Name <span class="text-danger">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" name="vendor_name" id="vendor_name" class="form-control" placeholder="Vendor display name" required value="{{ $user->vendor_name }}">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label class="form-label col-sm-2 pt-0">Company Name <span class="text-danger">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company name" required value="{{ $user->company_name }}">
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <label class="form-label col-sm-2 pt-0">Email <span class="text-danger">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Email" required value="{{ $user->email }}">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label class="form-label col-sm-2 pt-0">Mobile <span class="text-danger">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile number" required value="{{ $user->mobile }}">
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" name="work_phone" id="work_phone" placeholder="Work phone number" class="form-control" value="{{ $user->work_phone }}">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label class="form-label col-sm-2 pt-0">GST Treatment <span class="text-danger">*</span></label>
                                <div class="col-sm-5">
                                    <select name="gst_treatment_id" id="gst_treatment_id" class="form-control js-example-basic-single select2-hidden-accessible" required onchange="toggleGSTFields()">
                                        <!-- <option value="" >Select GST Treatment of vendor</option> -->
                                        @foreach($gst_treatment as $val)
                                            <option value="{{ $val->id }}" {{ $user->gst_treatment_id==$val->id ? 'selected':'' }}>{{ $val->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" name="pan" id="pan" placeholder="PAN number" class="form-control" value="{{ $user->pan }}">
                                </div>
                            </div>

                            <div class="row gst_fields">
                                <div class="row mb-4">
                                    <label class="form-label col-sm-2 pt-0">GSTIN / UIN <span class="text-danger">*</span></label>
                                    <div class="col-sm-5">
                                        <input type="text" name="gstin" id="gstin" placeholder="GSTIN / UIN " class="form-control" value="{{ $user->gstin }}">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="form-label col-sm-2 pt-0">Business Legal Name</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="business_legal_name" id="business_legal_name" placeholder="Business Legal Name" class="form-control" value="{{ $user->business_legal_name }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label class="form-label col-sm-2 pt-0">Currency</label>
                                <div class="col-sm-5">
                                    <select name="currency" id="currency" class="form-control js-example-basic-single select2-hidden-accessible">
                                        <!-- <option value="" >Select GST Treatment of vendor</option> -->
                                        @foreach($currency as $val)
                                            <option value="{{ $val->code }}" {{ $user->currency==$val->code ? 'selected':'' }}>{{ $val->code .' - '.$val->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="form-label col-sm-2 pt-0">Opening Balance</span></label>
                                <div class="col-sm-5">
                                    <input type="text" name="opening_balance" id="opening_balance" placeholder="Opening Balance" class="form-control" value="{{ $user->opening_balance }}">
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-4">
                                <label class="form-label col-sm-2 pt-0">Billing Address</label>
                                <div class="col-sm-5 form-group">
                                    <label>Address</label>
                                    <textarea name="billing_street" id="billing_street" rows="2" class="form-control" placeholder="Billing address">{{ $user->billing_street }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="form-label col-sm-2 pt-0"></label>
                                <div class="col-sm-3 form-group">
                                    <label>Country </label>
                                    <input type="text" name="billing_country" id="billing_country" class="form-control" placeholder="Billing country" value="{{ $user->billing_country }}">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>City </label>
                                    <input type="text" name="billing_city" id="billing_city" class="form-control" placeholder="Billing city" value="{{ $user->billing_city }}">
                                </div>
                                <div class="col-sm-2">
                                    <label>State </label>
                                    <input type="text" name="billing_state" id="billing_state" class="form-control" placeholder="Billing state" value="{{ $user->billing_state }}">
                                </div>
                                <div class="col-sm-2 form-group">
                                    <label>Postal Code</label>
                                    <input type="text" name="billing_zip_code" id="billing_zip_code" class="form-control" placeholder="Billing postal code" value="{{ $user->billing_zip_code }}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="form-label col-sm-2 pt-0"></label>
                                <div class="col-sm-5 form-group">
                                    <label>Phone</label>
                                    <input type="text" name="billing_phone" id="billing_phone" class="form-control" placeholder="Billing phone" value="{{ $user->billing_phone }}">
                                </div>
                                <div class="col-sm-5">
                                    <label>Fax Number</label>
                                    <input type="text" name="billing_fax" id="billing_fax" class="form-control" placeholder="Billing fax" value="{{ $user->billing_fax }}">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label class="form-label col-sm-2 pt-0">Shipping Address</label>
                                <div class="col-sm-5 form-group">
                                    <label>Address</label>
                                    <textarea name="shipping_street" id="shipping_street" rows="2" class="form-control" placeholder="Shipping address">{{ $user->shipping_street }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="form-label col-sm-2 pt-0"></label>
                                <div class="col-sm-3 form-group">
                                    <label>Country </label>
                                    <input type="text" name="shipping_country" id="shipping_country" class="form-control" placeholder="Shipping country" value="{{ $user->shipping_country }}">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>City </label>
                                    <input type="text" name="shipping_city" id="shipping_city" class="form-control" placeholder="Shipping city" value="{{ $user->shipping_city }}">
                                </div>
                                <div class="col-sm-2">
                                    <label>State </label>
                                    <input type="text" name="shipping_state" id="shipping_state" class="form-control" placeholder="Shipping state" value="{{ $user->shipping_state }}">
                                </div>
                                <div class="col-sm-2 form-group">
                                    <label>Postal Code</label>
                                    <input type="text" name="shipping_zip_code" id="shipping_zip_code" class="form-control" placeholder="Shipping postal code" value="{{ $user->shipping_zip_code }}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="form-label col-sm-2 pt-0"></label>
                                <div class="col-sm-5 form-group">
                                    <label>Phone </label>
                                    <input type="text" name="shipping_phone" id="shipping_phone" class="form-control" placeholder="Shipping phone" value="{{ $user->shipping_phone }}">
                                </div>
                                <div class="col-sm-5">
                                    <label>Fax Number </label>
                                    <input type="text" name="shipping_fax" id="shipping_fax" class="form-control" placeholder="Shipping fax" value="{{ $user->shipping_fax }}">
                                </div>
                            </div>

                            <br>

                            <div class="row mb-4">
                                <label class="form-label col-sm-2 pt-0">Remarks</span></label>
                                <div class="col-sm-5">
                                    <textarea name="remarks" id="remarks" rows="2" class="form-control" placeholder="Remarks">{{ $user->remarks }}</textarea>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 mt-4 gap-4 text-end">
                                    <button type="button" class="btn btn-light mx-3">
                                        <a href="{{ route('vendors.index') }}">Cancel</a>
                                    </button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                            </div>
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
    function toggleGSTFields() {
        var gstTreatmentId = document.getElementById("gst_treatment_id").value;
        var gstinField = document.getElementById("gstin");
        var businessLegalNameField = document.getElementById("business_legal_name");

        if (gstTreatmentId == 1 || gstTreatmentId == 2) {
            $(".gst_fields").show();
            gstinField.required = true;
        } else {
            $(".gst_fields").hide();
            gstinField.required = false;
        }
    }

    var gstTreatmentId = document.getElementById("gst_treatment_id").value;

    if(gstTreatmentId == 1 || gstTreatmentId == 2 ){
        $(".gst_fields").show();
    }else{
        $(".gst_fields").hide();
    }

document.addEventListener('DOMContentLoaded', function () {
    var firstNameField = document.getElementById('first_name');
    var lastNameField = document.getElementById('last_name');
    var vendorNameField = document.getElementById('vendor_name');
    firstNameField.addEventListener('input', updateVendorName);
    lastNameField.addEventListener('input', updateVendorName);
    function updateVendorName() {
        var firstName = firstNameField.value.trim();
        var lastName = lastNameField.value.trim();
        var vendorDisplayName = '';
        if (firstName !== '' && lastName !== '') {
            vendorDisplayName = firstName + ' ' + lastName;
        } else if (firstName !== '') {
            vendorDisplayName = firstName;
        } else if (lastName !== '') {
            vendorDisplayName = lastName;
        }
        vendorNameField.value = vendorDisplayName;
    }
});
</script>
@endsection
