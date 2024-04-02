@extends('layouts.master')
@section('title') @lang('translation.placeofsupply') @endsection
@section('css')
<!--datatables css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') <a href="{{ route('settings.placeofsupply.index') }}"> @lang('translation.placeofsupply')</a> @endslot
        @slot('title') List @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-border-left alert-dismissible fade show role="alert">
                    <i class="ri-check-double-line me-3 align-middle"></i>
                    <strong>Success! </strong> {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Place of Supply</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            @can('placeofsupply-create')
                                <a href="{{ route('settings.placeofsupply.create') }}" >
                                <button type="button" class="btn btn-md btn-primary">
                                    <i class="ri-add-line align-middle me-1"></i>Add 
                                </button>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row">
                            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle mt-3" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $row)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->short_code }}</td>
                                        <td>{{ $row->type }}</td>
                                        <td>
                                            <!-- @can('placeofsupply-show')
                                                <a class="btn btn-sm btn-info" href="{{ route('settings.placeofsupply.show',$row->id) }}">Show</a>
                                            @endcan -->
                                            @can('placeofsupply-edit')
                                                <a class="btn btn-sm btn-primary" href="{{ route('settings.placeofsupply.edit',$row->id) }}">Edit</a>
                                            @endcan
                                            @can('placeofsupply-delete')
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['settings.placeofsupply.destroy', $row->id], 'style' => 'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm("Are you sure you want to delete?")']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
