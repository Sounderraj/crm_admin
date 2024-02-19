@extends('layouts.master')
@section('title') @lang('translation.tax_rate') @endsection
@section('css')
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
                                    <th>Tax Name</th>
                                    <th>Tax Type</th>
                                    <th>Rate Percentage (%)</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $row)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $row->tax_name }}</td>
                                        <td>{{ $row->tax_type }}</td>
                                        <td>{{ $row->tax_rate_percentage }}</td>
                                        <td>
                                            <!-- @can('taxrates-show')
                                                <a class="btn btn-sm btn-info" href="{{ route('settings.taxrates.show',$row->id) }}">Show</a>
                                            @endcan -->
                                            @can('taxrates-edit')
                                                <a class="btn btn-sm btn-primary" href="{{ route('settings.taxrates.edit',$row->id) }}">Edit</a>
                                            @endcan
                                            @can('taxrates-delete')
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['settings.taxrates.destroy', $row->id], 'style' => 'display:inline']) !!}
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
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
