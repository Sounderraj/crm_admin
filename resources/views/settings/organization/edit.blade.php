@extends('layouts.master')
@section('title') @lang('translation.organization') @endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') <a href="{{ route('settings.organization.index') }}">@lang('translation.organization')</a> @endslot
        @slot('title') Organization Profile @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
             @if ($message = Session::get('success'))
                <div class="alert alert-success alert-border-left alert-dismissible fade show role="alert">
                    <i class="ri-check-double-line me-3 align-middle"></i>
                    <strong>Success! </strong> {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
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
                    <h4 class="card-title mb-0 flex-grow-1">Organization Profile</h4>
                    <!-- <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <label for="FormSelectDefault" class="form-label text-muted">Show Code</label>
                            <input class="form-check-input code-switcher" type="checkbox" id="FormSelectDefault">
                        </div>
                    </div> -->
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row">
                        <form action="{{ route('settings.organization.update', $organization->id) }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')
                            @csrf
                            <div class="row mb-3">
                                
                                <div class="row mb-3">
                                    <div class="col-sm-6 form-group">
                                        <label>Organization Name </label> <span class="text-danger">*</span>
                                        <input type="text" name="org_name" id="org_name" class="form-control" placeholder="Organization Name" required value="{{ $organization->org_name }}">
                                    </div>
                                    <div class="col-sm-6 form-group ">
                                            <label>Industry</label> <span class="text-danger">*</span>
                                            @php
                                                $industryValues = \App\Models\Organization::getIndustryEnumValues();
                                            @endphp
                                            <select name="industry" id="industry" class="form-control js-example-basic-single select2-hidden-accessible" required>
                                                @foreach($industryValues as $val)
                                                    <option value="{{ $val }}" {{ $organization->industry==$val ? 'selected':'' }} >{{ $val }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6 form-group">
                                            <label>Organization Location</label> <span class="text-danger">*</span>
                                            <select name="org_country" id="org_country" class="form-control js-example-basic-single select2-hidden-accessible" required disabled>
                                                <option value="India">India</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="form-label col-sm-2 pt-0">Organization Address</label>
                                    <div class="col-sm-5 form-group">
                                        <label>Street 1 </label>
                                        <input type="text" name="org_street1" id="org_street1" class="form-control" placeholder="Street 1" value="{{ $organization->org_street1 }}">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="form-label col-sm-2 pt-0"></label>
                                    <div class="col-sm-5 form-group">
                                        <input type="text" name="org_street2" id="org_street2" class="form-control" placeholder="Street 2" value="{{ $organization->org_street2 }}">
                                    </div>
                                </div>


                                <div class="row mb-4">
                                    <label class="form-label col-sm-2 pt-0"></label>
                                    <div class="col-sm-3 form-group">
                                        <label>City </label>
                                        <input type="text" name="org_city" id="org_city" class="form-control" placeholder="city" value="{{ $organization->org_city }}">
                                    </div>
                                    <div class="col-sm-3">
                                        <label>State </label>
                                        <input type="text" name="org_state" id="org_state" class="form-control" placeholder="state" value="{{ $organization->org_state }}">
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label>Postal Code</label>
                                        <input type="text" name="org_zip_code" id="org_zip_code" class="form-control" placeholder="postal code" value="{{ $organization->org_zip_code }}">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="form-label col-sm-2 pt-0"></label>
                                    <div class="col-sm-3 form-group">
                                        <label>Phone</label>
                                        <input type="text" name="org_phone" id="org_phone" class="form-control" placeholder="phone" value="{{ $organization->org_phone }}">
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Fax Number</label>
                                        <input type="text" name="org_fax" id="org_fax" class="form-control" placeholder="fax" value="{{ $organization->org_fax }}">
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Website URL</label>
                                        <input type="text" name="org_website_url" id="org_website_url" class="form-control" placeholder="Website URL" value="{{ $organization->org_website_url }}">
                                    </div>
                                </div>
                                
                                <hr>
                                <div class="row mb-3">                                    
                                    <div class="col-sm-6 form-group">
                                        <div class="form-check form-switch form-check-right">
                                            <input class="form-check-input" type="checkbox" role="switch" id="gst_registered_switch" name="gst_registered" {{ $organization->gst_registered ? 'checked':'' }}>
                                            <label class="form-check-label" for="gst_registered_switch">Is your business registered for GST?</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3" id="GSTIN_field" style="{{ isset($organization->gst_registered) && !empty($organization->gst_registered) ? '' : 'display:none' }}">
                                    <div class="col-sm-6 form-group">
                                        <label>GSTIN </label> <span class="text-danger">*</span>
                                        <input type="text" name="GSTIN" id="GSTIN" class="form-control" placeholder="GSTIN" value="{{ $organization->GSTIN }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6 form-group">
                                        <label>TAN </label>
                                        <input type="text" name="TAN" id="TAN" class="form-control" placeholder="TAN" value="{{ $organization->TAN }}">
                                    </div>
                                </div>

                                <hr>
                                <div class="row mb-3">
                                    <div class="col-sm-6 form-group">
                                        <label>Language </label> <span class="text-danger">*</span>
                                        <input type="text" name="language" id="language" class="form-control" placeholder="language" value="{{ $organization->language }}" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6 form-group">
                                        <label>Time Zone </label> <span class="text-danger">*</span>
                                        <input type="text" name="time_zone" id="time_zone" class="form-control" placeholder="time_zone" value="{{ $organization->time_zone }}" disabled>
                                    </div>
                                </div>


                                <br>
                                <div class="col-sm-6 mt-3 gap-4 text-end">
                                    <button type="button" class="btn btn-light mx-3">
                                        <a href="{{ route('settings.organization.index') }}">Cancel</a>
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
    // Get references to the checkbox and the GSTIN field
    var gstCheckbox = document.getElementById('gst_registered_switch');
    var gstinField = document.getElementById('GSTIN_field');
    var gstin = document.getElementById('GSTIN');

    // Toggle GSTIN field visibility based on checkbox state
    gstCheckbox.addEventListener('change', function() {
        
        if (this.checked) {
            gstinField.style.display = 'block';
            gstin.required = true;
        } else {
            gstinField.style.display = 'none';
            gstin.required = false;
        }
    });
</script>
@endsection
