@extends('layouts.master')
@section('title') @lang('translation.timeline') @endsection
@section('css')
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') <a href="{{ route('product.index') }}">Products</a> @endslot
        @slot('title') Edit @endslot
    @endcomponent

    <!-- <div class="pull-right">
        <a class="btn btn-primary" style="float: right" href="{{ route('product.index') }}"> Back</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Edit Product</h4>
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
                        <form action="{{ route('product.update', $product->id) }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')
                                <div class="col-lg-5 form-group">
                                    <label for="name">Product Name</label> <span class="text-danger">*</span>
                                    <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control" required>
                                </div>

                                <div class="col-lg-5 form-group mt-3">
                                    <label for="sku_number">SKU Number</label> <span class="text-danger">*</span>
                                    <input type="text" name="sku_number" id="sku_number" value="{{ $product->sku_number }}" class="form-control" required>
                                </div>

                                <div class="col-lg-5 form-group mt-3">
                                    <label for="rate">Product Rate</label> <span class="text-danger">*</span>
                                    <input type="number" name="rate" id="rate" value="{{ $product->rate }}" class="form-control" required>
                                </div>
                                
                                <div class="col-lg-5 form-group mt-3">
                                    <label for="quantity">Product Quantity</label> <span class="text-danger">*</span>
                                    <input type="number" name="quantity" id="quantity" value="{{ $product->quantity }}"  class="form-control" required>
                                </div>
                                <div class="col-lg-5 form-group mt-3">
                                    <label for="unit">Unit</label> <span class="text-danger">*</span>
                                    <input type="text" name="unit" id="unit" value="{{ $product->unit }}"  class="form-control" required>
                                </div>

                                <div class="col-lg-5 form-group mt-3">
                                    <label for="description">Description</label> <span class="text-danger">*</span>
                                    <textarea name="description" id="description" class="form-control" required>{{ $product->description }}</textarea>
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
