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

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="container">
        <h2>Permission List</h2>

        @can('permission-create')
        <a href="{{ route('permissions.create') }}" style="float:right;" class="btn btn-success">Create Permission</a>
        @endcan

        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle mt-3" style="width:100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>
                        @can('permission-edit')
                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        @endcan
                        @can('permission-delete')
                        {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id], 'style' => 'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm("Are you sure you want to delete?")']) !!}
                        {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No permissions found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/timeline.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
