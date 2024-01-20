@extends('layouts.master')
@section('title') @lang('translation.timeline') @endsection
@section('css')
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') <a href="{{ route('customer.index') }}">Customers</a> @endslot
        @slot('title') Edit @endslot
    @endcomponent

    <!-- <div class="pull-right">
        <a class="btn btn-primary" style="float: right" href="{{ route('customer.index') }}"> Back</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Edit Customer</h4>
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
                        <form action="{{ route('customer.update', $user->id) }}" method="post" class="needs-validation" novalidate>
            @csrf
            @method('PUT')

            <div class="col-lg-5 form-group">
                    <label for="name">Name</label> <span class="text-danger">*</span>
                    <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control" required>
                </div>

                <div class="col-lg-5 form-group mt-3">
                    <label for="company_name">Company Name</label> <span class="text-danger">*</span>
                    <input type="text" name="company_name" id="company_name" value="{{ $user->company_name }}" class="form-control" required>
                </div>

                <div class="col-lg-5 form-group mt-3">
                    <label for="email">Email</label> <span class="text-danger">*</span>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control" required>
                </div>

                <div class="col-lg-5 mt-3">
                    <label for="phone">Phone number</label> <span class="text-danger">*</span>
                </div>

                
                <div class="input-group col-lg-5 form-group mt-1" data-input-flag="" style="width: 467px">
                    <button class="btn btn-light border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset('build/images/flags/in.svg')}}" alt="flag img" height="20" class="country-flagimg rounded">
                        <span class="ms-2 country-codeno">+91</span></button>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}" required maxlength="10"
                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                </div>

                <div class="col-lg-5 form-group mt-3">
                    <label for="address">Address</label> <span class="text-danger">*</span>
                    <textarea name="address" id="address" class="form-control" required>{{ $user->address }}</textarea>
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
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/timeline.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
