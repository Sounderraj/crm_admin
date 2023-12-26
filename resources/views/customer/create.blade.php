@extends('layouts.master')
@section('title') @lang('translation.timeline') @endsection
@section('css')
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Customer @endslot
        @slot('title') Create @endslot
    @endcomponent
    <div class="pull-right">
        <a class="btn btn-primary" style="float: right" href="{{ route('customer.index') }}"> Back</a>
    </div>

    <div class="container">
        <h2 class="text-center">Create Customer</h2>

        <div class="row mt-5">
            <form action="{{ route('customer.store') }}" method="post" class="needs-validation" novalidate>
                @csrf

                <div class="col-lg-5 form-group">
                    <label for="name">Name</label> <span class="text-danger">*</span>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="col-lg-5 form-group mt-3">
                    <label for="company_name">Company Name</label> <span class="text-danger">*</span>
                    <input type="text" name="company_name" id="company_name" class="form-control" required>
                </div>

                <div class="col-lg-5 form-group mt-3">
                    <label for="email">Email</label> <span class="text-danger">*</span>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="col-lg-5 mt-3">
                    <label for="phone">Phone number</label> <span class="text-danger">*</span>
                </div>

                <div class="input-group col-lg-5 form-group mt-1" data-input-flag="" style="width: 467px">
                    <button class="btn btn-light border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset('build/images/flags/in.svg')}}" alt="flag img" height="20" class="country-flagimg rounded">
                        <span class="ms-2 country-codeno">+91</span></button>
                    <input type="text" name="phone" id="phone" class="form-control" required maxlength="10"
                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                </div>

                <div class="col-lg-5 form-group mt-3">
                    <label for="address">Address</label> <span class="text-danger">*</span>
                    <textarea name="address" id="address" class="form-control" required></textarea>
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

@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/timeline.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
