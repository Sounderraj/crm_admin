@extends('layouts.master')
@section('title') @lang('translation.timeline') @endsection
@section('css')
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') User Management @endslot
        @slot('title') Roles @endslot
    @endcomponent

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="container">
    <h2>Role List</h2>

    @can('role-create')
        <a class="btn btn-success" style="float: right" href="{{ route('roles.create') }}"> Create New Role</a>
    @endcan
    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle mt-3" style="width:100%">
        <thead>
            <tr>

            <th>No</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($roles as $key => $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-sm btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                    @can('role-edit')
                        <a class="btn btn-sm btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                    @endcan
                    @can('role-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm("Are you sure you want to delete?")']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


{!! $roles->render() !!}
@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/timeline.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
