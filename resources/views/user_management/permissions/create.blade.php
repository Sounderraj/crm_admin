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

    <div class="container">
        <h2>Create Permission</h2>

        <form action="{{ route('permissions.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="guard_name">Guard Name</label>
                <input type="text" name="guard_name" id="guard_name" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Permission</button>
        </form>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/timeline.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
