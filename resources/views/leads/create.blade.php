@extends('layouts.master')
@section('title') @lang('translation.timeline') @endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') <a href="{{ route('leads.index') }}">Leads</a> @endslot
        @slot('title') Create @endslot
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
                    <h4 class="card-title mb-0 flex-grow-1">Create Leads</h4>

                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row ">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">

                                <form action="{{ route('leads.store') }}" method="post" class="needs-validation" novalidate>
                                @csrf
                                    <div class="col-lg-5 form-group">
                                        <label for="name">Name</label> <span class="text-danger">*</span>
                                        <input type="text" name="name" id="name" class="form-control" required>
                                    </div>
                                    <div class="col-lg-5 form-group mt-3">
                                        <label for="title">Title</label> <span class="text-danger">*</span>
                                        <input type="text" name="title" id="title" class="form-control" required>
                                    </div>
                                    <div class="col-lg-5 form-group mt-3">
                                        <label for="company_name">Company Name</label> <span class="text-danger">*</span>
                                        <input type="text" name="company_name" id="company_name" class="form-control" required>
                                    </div>
                                    @if(0)
                                    <!-- <div class="col-lg-5 form-group mt-3">
                                        <label for="customer_id">Company Name</label> <span class="text-danger">*</span>
                                        <select class="js-example-basic-single" name="customer_id" id="customer_id" required>
                                            <option value="">Select Customer name</option> -->
                                            <!-- @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->company_name }}</option>
                                            @endforeach -->
                                        <!-- </select>
                                    </div> -->
                                    @endif
                                    <div class="col-lg-5 form-group mt-3">
                                        <label for="phone">Phone</label> <span class="text-danger">*</span>
                                        <input type="text" name="phone" id="phone" class="form-control" required>
                                    </div>
                                    <div class="col-lg-5 form-group mt-3">
                                        <label for="leads_owner">Leads Responsible</label> <span class="text-danger">*</span>
                                        <input type="text" name="leads_owner" id="leads_owner" class="form-control" required>
                                    </div>

                                    <div class="col-lg-5 form-group mt-3">
                                        <label for="leads_score">Lead Score</label> <span class="text-danger">*</span>
                                        <input type="number" name="leads_score" id="leads_score" class="form-control" required>
                                    </div>

                                    <div class="col-lg-5 form-group mt-3">
                                        <label for="leads_status">Lead Status</label> <span class="text-danger">*</span>
                                        <select class="js-example-basic-single" name="leads_status" id="leads_status" required>
                                            <option value="">Select Lead Staus</option>
                                            @foreach($statusValues as $status)
                                                <option value="{{ $status }}">{{ $status }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="row text-left mt-5">
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
