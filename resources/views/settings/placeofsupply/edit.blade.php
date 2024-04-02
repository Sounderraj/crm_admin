@extends('layouts.master')
@section('title') @lang('translation.tax_rate') @endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') <a href="{{ route('settings.placeofsupply.index') }}">@lang('translation.tax_rate')</a> @endslot
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
                    <h4 class="card-title mb-0 flex-grow-1">Edit Place of Supply</h4>
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
                        <form action="{{ route('settings.placeofsupply.update', $placeofsupply->id) }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')
                            @csrf
                            <div class="row mb-3">  
                                
                                <div class="row mb-3">                                    
                                    <div class="col-sm-6 form-group">
                                        <label>Code</label> <span class="text-danger">*</span>
                                        <input type="text" name="short_code" id="short_code" class="form-control" placeholder="code" required value="{{ $placeofsupply->short_code }}">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">                                    
                                    <div class="col-sm-6 form-group">
                                        <label>Name</label> <span class="text-danger">*</span>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="name" required value="{{ $placeofsupply->name }}">
                                    </div>
                                </div>

                                <div class="row mb-3">                                    
                                    <div class="col-sm-6 form-group">
                                        <label>Code</label> <span class="text-danger">*</span>
                                        <select name="type" id="type" class="form-control js-example-basic-single select2-hidden-accessible" required>
                                            @php
                                                $types = \App\Models\PlaceOfSupply::getPlaceOfSupplyTypeEnumValues();
                                            @endphp
                                            @foreach($types as $val)
                                                <option value="{{ $val }}"  {{ $placeofsupply->type==$val ? 'selected':'' }} >{{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <br>
                                <div class="col-sm-6 mt-3 gap-4 text-end">
                                    <button type="button" class="btn btn-light mx-3">
                                        <a href="{{ route('settings.placeofsupply.index') }}">Cancel</a>
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
@endsection
