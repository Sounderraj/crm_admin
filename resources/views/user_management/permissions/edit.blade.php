@extends('layouts.master')
@section('title') @lang('translation.timeline') @endsection
@section('css')
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') User Management @endslot
        @slot('title') Permissions @endslot
    @endcomponent

    <div class="pull-right">
        <a class="btn btn-primary" style="float: right" href="{{ route('permissions.index') }}"> Back</a>
    </div>
    <div class="container">
        <h2>Edit Permission</h2>

        <form action="{{ route('permissions.update', $permission->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $permission->name }}" required>
            </div>

            <div class="form-group" style="display: none">
                <label for="guard_name">Guard Name</label>
                <input type="text" name="guard_name" id="guard_name" class="form-control" value="{{ $permission->guard_name }}" required>
            </div>

            <div class="row text-center mt-3">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <button type="submit" class="btn btn-success">Update Permission</button>
                </div>
            </div>
        </form>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/timeline.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
