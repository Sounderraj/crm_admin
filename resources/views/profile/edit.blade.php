@extends('layouts.master')
@section('title') @lang('translation.products') @endsection
@section('css')
@endsection
@section('content')

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
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-border-left alert-dismissible fade show role="alert">
                <i class="ri-check-double-line me-3 align-middle"></i>
                <strong>Success! </strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div class="col-xxl-3">
        <div class="card card-bg-fill">
            <div class="card-body p-4">
                <div class="text-center">
                    <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                        <img src="@if (Auth::user()->avatar != '') {{ URL::asset('images/' . Auth::user()->avatar) }}@else{{ URL::asset('build/images/users/avatar-1.jpg') }} @endif"
                            class="  rounded-circle avatar-xl img-thumbnail user-profile-image"
                            alt="user-profile-image">
                        <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                            <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                            <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                <span class="avatar-title rounded-circle bg-light text-body">
                                    <i class="ri-camera-fill"></i>
                                </span>
                            </label>
                        </div>
                    </div>
                    <h5 class="fs-16 mb-1">{{ auth()->user()->name }}</h5>
                    <p class="text-muted mb-0">{{ auth()->user()->roles->first()->name }}</p>
                </div>
            </div>
        </div>
        <!--end card-->
        <!-- <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-5">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-0">Complete Your Profile</h5>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="javascript:void(0);" class="badge bg-light text-primary fs-12"><i
                                class="ri-edit-box-line align-bottom me-1"></i> Edit</a>
                    </div>
                </div>
                <div class="progress animated-progress custom-progress progress-label">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 30%" aria-valuenow="30"
                        aria-valuemin="0" aria-valuemax="100">
                        <div class="label">30%</div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-0">Portfolio</h5>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="javascript:void(0);" class="badge bg-light text-primary fs-12"><i
                                class="ri-add-fill align-bottom me-1"></i> Add</a>
                    </div>
                </div>
                <div class="mb-3 d-flex">
                    <div class="avatar-xs d-block flex-shrink-0 me-3">
                        <span class="avatar-title rounded-circle fs-16 bg-body text-body">
                            <i class="ri-github-fill"></i>
                        </span>
                    </div>
                    <input type="email" class="form-control" id="gitUsername" placeholder="Username"
                        value="@daveadame">
                </div>
                <div class="mb-3 d-flex">
                    <div class="avatar-xs d-block flex-shrink-0 me-3">
                        <span class="avatar-title rounded-circle fs-16 bg-primary">
                            <i class="ri-global-fill"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="websiteInput" placeholder="www.example.com"
                        value="www.CRMcom">
                </div>
                <div class="mb-3 d-flex">
                    <div class="avatar-xs d-block flex-shrink-0 me-3">
                        <span class="avatar-title rounded-circle fs-16 bg-success">
                            <i class="ri-dribbble-fill"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="dribbleName" placeholder="Username"
                        value="@dave_adame">
                </div>
                <div class="d-flex">
                    <div class="avatar-xs d-block flex-shrink-0 me-3">
                        <span class="avatar-title rounded-circle fs-16 bg-danger">
                            <i class="ri-pinterest-fill"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="pinterestName" placeholder="Username"
                        value="Advance Dave">
                </div>
            </div>
        </div> -->
        <!--end card-->
    </div>
    <!--end col-->
    <div class="col-xxl-9">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                            <i class="fas fa-home"></i>
                            Personal Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                            <i class="far fa-user"></i>
                            Change Password
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#experience" role="tab">
                            <i class="far fa-envelope"></i>
                            Experience
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#privacy" role="tab">
                            <i class="far fa-envelope"></i>
                            Privacy Policy
                        </a>
                    </li> -->
                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="personalDetails" role="tabpanel">
                        <form action="{{ route('profile.update', auth()->user()->id) }}" class="needs-validation" novalidate >
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="firstnameInput" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" id="firstnameInput"
                                            placeholder="Enter your name" value="{{ auth()->user()->name }}">
                                    </div>
                                </div>
                                <!--end col-->
                                <!-- <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="lastnameInput" class="form-label">Last
                                            Name</label>
                                        <input type="text" class="form-control" id="lastnameInput"
                                            placeholder="Enter your lastname" value="Adame">
                                    </div>
                                </div> -->
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="phonenumberInput" class="form-label">Mobile
                                            Number</label>
                                        <input type="text" name="mobile" class="form-control" id="phonenumberInput"
                                            placeholder="Enter your mobile number" value="{{ auth()->user()->mobile }}">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="emailInput" class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" id="emailInput"
                                            placeholder="Enter your email" value="{{ auth()->user()->email }}">
                                    </div>
                                </div>
                                <!--end col-->
                                <!-- <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="JoiningdatInput" class="form-label">Joining
                                            Date</label>
                                        <input type="text" class="form-control" data-provider="flatpickr"
                                            id="JoiningdatInput" data-date-format="d M, Y"
                                            data-deafult-date="24 Nov, 2021" placeholder="Select date" />
                                    </div>
                                </div> -->
                                <!--end col-->
                                <!-- <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="skillsInput" class="form-label">Skills</label>
                                        <select class="form-control" name="skillsInput" data-choices
                                            data-choices-text-unique-true multiple id="skillsInput">
                                            <option value="illustrator">Illustrator</option>
                                            <option value="photoshop">Photoshop</option>
                                            <option value="css">CSS</option>
                                            <option value="html">HTML</option>
                                            <option value="javascript" selected>Javascript</option>
                                            <option value="python">Python</option>
                                            <option value="php">PHP</option>
                                        </select>
                                    </div>
                                </div> -->
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="designationInput" class="form-label">Designation</label>
                                        <input type="text" class="form-control" id="designationInput"
                                            placeholder="Designation" value="{{ auth()->user()->roles->first()->name }}" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <!-- <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="websiteInput1" class="form-label">Website</label>
                                        <input type="text" class="form-control" id="websiteInput1"
                                            placeholder="www.example.com" value="www.CRMcom" />
                                    </div>
                                </div> -->
                                <!--end col-->
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="countryInput" class="form-label">Country</label>
                                        <input type="text" name="country" class="form-control" id="countryInput"
                                            placeholder="Country" value="{{ auth()->user()->country }}" />
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="StateInput" class="form-label">State</label>
                                        <input type="text" name="state" class="form-control" id="StateInput" placeholder="State"
                                            value="{{ auth()->user()->state }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="cityInput" class="form-label">City</label>
                                        <input type="text" name="city" class="form-control" id="cityInput" placeholder="City"
                                            value="{{ auth()->user()->city }}" />
                                    </div>
                                </div>
                                
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="mb-3 pb-2">
                                        <label for="exampleFormControlTextarea"
                                            class="form-label">Description</label>
                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea" placeholder="Enter your description"
                                            rows="3">{{ auth()->user()->description }}</textarea>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <button type="button" class="btn btn-soft-danger">Cancel</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane" id="changePassword" role="tabpanel">
                        <form action="javascript:void(0);">
                            <div class="row g-2">
                                <div class="col-lg-4">
                                    <div>
                                        <label for="oldpasswordInput" class="form-label">Old
                                            Password*</label>
                                        <input type="password" class="form-control" id="oldpasswordInput"
                                            placeholder="Enter current password">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="newpasswordInput" class="form-label">New
                                            Password*</label>
                                        <input type="password" class="form-control" id="newpasswordInput"
                                            placeholder="Enter new password">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="confirmpasswordInput" class="form-label">Confirm
                                            Password*</label>
                                        <input type="password" class="form-control" id="confirmpasswordInput"
                                            placeholder="Confirm password">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <a href="javascript:void(0);"
                                            class="link-primary text-decoration-underline">Forgot
                                            Password ?</a>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Change
                                            Password</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
@endsection
@section('script')
<script src="{{ URL::asset('build/js/pages/profile-setting.init.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/form-validation.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
