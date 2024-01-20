@extends('layouts.master')
@section('title') @lang('translation.timeline') @endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') <a href="{{ route('estimate.index') }}">Estimate</a> @endslot
        @slot('title') Edit @endslot
    @endcomponent

    <!-- <div class="pull-right">
        <a class="btn btn-primary" style="float: right" href="{{ route('estimate.index') }}"> Back</a>
    </div> -->

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
                    <h4 class="card-title mb-0 flex-grow-1">Edit Estimate</h4>
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
                        <form action="{{ route('estimate.update', $estimate->id) }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                                <div class="col-lg-5 form-group">
                                    <label for="quote_date">Quote Date</label> <span class="text-danger">*</span>
                                    <input type="date" name="quote_date" id="quote_date" value="{{ $estimate->quote_date }}" class="form-control" required>
                                </div>

                                <div class="col-lg-5 form-group mt-3">
                                    <label for="customer_id">Company Name</label> <span class="text-danger">*</span>
                                    <!-- <input type="text" name="customer_id" id="customer_id" class="form-control" required> -->
                                    <select class="js-example-basic-single" name="customer_id" id="customer_id" required>
                                        <option value="">Select Customer name</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}" {{ $customer->id == $estimate->customer_id ? 'selected' : '' }}>
                                                {{ $customer->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-5 form-group mt-3">
                                    <label for="subject_name">Subject</label> <span class="text-danger">*</span>
                                    <input type="text" name="subject_name" id="subject_name" class="form-control" value="{{ $estimate->subject_name }}"  required>
                                </div>

                                <div class="col-lg-5 form-group mt-3">
                                    <label for="reference_number">Reference Number</label> <span class="text-danger">*</span>
                                    <input type="text" name="reference_number" id="reference_number" value="{{ $estimate->reference_number }}"  class="form-control" required>
                                </div>

                                <div class="col-lg-5 form-group mt-3">
                                    <label for="rate">Quatation Total Rate</label> <span class="text-danger">*</span>
                                    <input type="number" name="rate" id="rate" value="{{ $estimate->rate }}"  class="form-control" required>
                                </div>

                                <div class="col-lg-5 form-group mt-3">
                                    <label for="status">Status</label> <span class="text-danger">*</span>
                                    <select class="js-example-basic-single" name="status" id="status" required>
                                        <option value="">Select Quatation Staus</option>
                                        @foreach($statusValues as $status)
                                            <option value="{{ $status }}" {{ $customer->id == $estimate->customer_id ? 'selected' : '' }}>
                                                {{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row text-left mt-3">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4">
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
<!--jquery cdn-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection