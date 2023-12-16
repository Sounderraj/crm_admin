@extends('layouts.master')
@section('title') @lang('translation.timeline') @endsection
@section('css')
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') User Management @endslot
        @slot('title') Users @endslot
    @endcomponent

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="container">
        <h2>Users List</h2>

            @can('user-create')
            <a href="{{ route('users.create') }}" style="float: right" class="btn btn-success">Create New User</a>
            @endcan

        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle mt-3" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                                <label class="badge bg-dark">{{ $v }}</label>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @can('user-show')
                            <a class="btn btn-sm btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
                        @endcan
                        @can('user-edit')
                            <a class="btn btn-sm btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                        @endcan
                        @can('user-delete')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm("Are you sure you want to delete?")']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/timeline.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
