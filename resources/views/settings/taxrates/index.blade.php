@extends('layouts.master')
@section('title') @lang('translation.tax_rate') @endsection
@section('css')
<!--datatables css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') <a href="{{ route('settings.taxrates.index') }}"> @lang('translation.tax_rate')</a> @endslot
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
                    <h4 class="card-title mb-0 flex-grow-1">Tax Rates</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            @can('taxrates-default-setup-update')
                                <a href="{{ route('settings.taxrates_default.edit',1) }}" >
                                <button type="button" class="btn btn-md btn-secondary">
                                    <i class="ri-star-s-line align-middle me-1"></i>Default Tax Preference
                                </button>
                                </a>
                            @endcan
                        </div>
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            @can('taxrates-create')
                                <a href="{{ route('settings.taxrates.create') }}" >
                                <button type="button" class="btn btn-md btn-primary">
                                    <i class="ri-add-line align-middle me-1"></i>Add Tax Rate
                                </button>
                                </a>
                               
                                <a href="{{ route('settings.taxrates_group.create') }}" >
                                <button type="button" class="btn btn-md btn-success">
                                    <i class="ri-add-line align-middle me-1"></i>Add Tax Group
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
                                    <th>Tax Name </th>
                                    <th>Tax Type</th>
                                    <th>Rate Percentage (%)</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $row)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $row->tax_name }} @if($row->tax_ids) &nbsp;&nbsp;<span class="badge bg-success text-white">Tax Group</span> @endif</td>
                                        <td>{{ $row->tax_type }} @if($row->tax_ids) SGST, CGST @endif</td></td>
                                        <td>{{ $row->tax_rate_percentage }}</td>
                                        <td>
                                            <!-- @can('taxrates-show')
                                                <a class="btn btn-sm btn-info" href="{{ route('settings.taxrates.show',$row->id) }}">Show</a>
                                            @endcan -->
                                            @can('taxrates-edit')
                                                @if($row->tax_ids)
                                                    <a class="btn btn-sm btn-primary" href="{{ route('settings.taxrates_group.edit',$row->id) }}">Edit</a>
                                                @else
                                                    <a class="btn btn-sm btn-primary" href="{{ route('settings.taxrates.edit',$row->id) }}">Edit</a>
                                                @endif
                                            @endcan
                                            @can('taxrates-delete')
                                                 @if($row->tax_ids)
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['settings.taxrates_group.destroy', $row->id], 'style' => 'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm("Are you sure you want to delete?")']) !!}
                                                    {!! Form::close() !!}
                                                @else
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['settings.taxrates.destroy', $row->id], 'style' => 'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm("Are you sure you want to delete?")']) !!}
                                                    {!! Form::close() !!}
                                                @endif

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
