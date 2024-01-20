@extends('layouts.master')
@section('title') @lang('translation.timeline') @endsection
@section('css')
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
    @slot('li_1') <a href="{{ route('product.index') }}">Products</a> @endslot
    @slot('title') Show @endslot
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
                <h4 class="card-title mb-0 flex-grow-1">Show Product</h4>
                <!-- <div class="flex-shrink-0">
                    <div class="form-check form-switch form-switch-right form-switch-md">
                        <label for="FormSelectDefault" class="form-label text-muted">Show Code</label>
                        <input class="form-check-input code-switcher" type="checkbox" id="FormSelectDefault">
                    </div>
                </div> -->
            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    <div class="row p-3">
                        <table class="table table-striped table-bordered" style="font-size: 15px">
                            <tr>
                                <td><strong>Product Name</strong></td>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>SKU Number</strong></td>
                                <td>{{ $product->sku_number }}</td>
                            </tr>
                            <tr>
                                <td><strong>Product Rate</strong></td>
                                <td>{{ $product->rate }}</td>
                            </tr>
                            <tr>
                                <td><strong>Product Quantity</strong></td>
                                <td>{{ $product->quantity }}</td>
                            </tr>
                            <tr>
                                <td><strong>Unit</strong></td>
                                <td>{{ $product->unit }}</td>
                            </tr>
                            <tr>
                                <td><strong>Product Description</strong></td>
                                <td>{{ $product->description }}</td>
                            </tr>

                        </table>
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
