@extends('layouts.master')
@section('title') @lang('translation.timeline') @endsection
@section('css')
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
    @slot('li_1') <a href="{{ route('leads.index') }}">Leadss</a> @endslot
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
                <h4 class="card-title mb-0 flex-grow-1">Show Leads</h4>
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
                            <td><strong>Name</strong></td>
                                <td>{{ $leads->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Title</strong></td>
                                <td>{{ $leads->title }}</td>
                            </tr>
                            <tr>
                                <td><strong>Customer Name</strong></td>
                                <td>{{ $leads->company_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Phone</strong></td>
                                <td>{{ $leads->phone }}</td>
                            </tr>
                            <tr>
                                <td><strong>Leads Owner</strong></td>
                                <td>{{ $leads->leads_owner}}</td>
                            </tr>
                            <tr>
                                <td><strong>Leads Status</strong></td>
                                <td>{{ $leads->leads_status }}</td>
                            </tr>
                            <tr>
                                <td><strong>Leads Score</strong></td>
                                <td>{{ $leads->leads_score }}</td>
                            </tr>
                            <tr>
                                <td><strong>Created At</strong></td>
                                <td>{{ $leads->created_at }}</td>
                            </tr>
                            <tr>
                                <td><strong>Updated At</strong></td>
                                <td>{{ $leads->updated_at }}</td>
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
