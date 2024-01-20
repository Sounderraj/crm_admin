@extends('layouts.master')
@section('title') @lang('translation.timeline') @endsection
@section('css')
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') <a href="{{ route('invoice.index') }}">Invoices</a> @endslot
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
                    <h4 class="card-title mb-0 flex-grow-1">Invoices</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            @can('estimate-create')
                                <a href="{{ route('invoice.create') }}" >
                                <button type="button" class="btn btn-md btn-primary">
                                    <i class="ri-add-line align-middle me-1"></i>Create
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
                                    <th>Quote Date</th>
                                    <th>Company Name</th>
                                    <th>Subject</th>
                                    <th>Estimate Number</th>
                                    <th>Rate (Rs)</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $estimate)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $estimate->quote_date }}</td>
                                        <td>{{ $estimate->customer->company_name }}</td>
                                        <td>{{ $estimate->subject_name }}</td>
                                        <td>{{ $estimate->estimate_number }}</td>
                                        <td>{{ $estimate->rate }}</td>
                                        <td>
                                            @php
                                                $statusColors = \App\Models\Estimate::getStatusEnumValues_ForButton();
                                            @endphp
                                            <h5><span class="badge rounded-pill bg-{{ $statusColors[$estimate->status] }}-subtle text-{{ $statusColors[$estimate->status] }}">
                                                {{ $estimate->status }}
                                            </span></h5>
                                        </td>

                                        <td>
                                            @can('estimate-show')
                                                <a class="btn btn-sm btn-info" href="{{ route('invoice.show',$estimate->id) }}">Show</a>
                                            @endcan
                                            @can('estimate-edit')
                                                <a class="btn btn-sm btn-primary" href="{{ route('invoice.edit',$estimate->id) }}">Edit</a>
                                            @endcan
                                            @can('estimate-delete')
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['invoice.destroy', $estimate->id], 'style' => 'display:inline']) !!}
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

        <!-- Modal -->
        <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-5 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                    <div class="mt-4 text-center">
                        <h4>You are about to delete a order ?</h4>
                        <p class="text-muted fs-15 mb-4">Deleting your order will remove
                            all of
                            your information from our database.</p>
                        <div class="hstack gap-2 justify-content-center remove">
                            <button class="btn btn-link link-success fw-medium text-decoration-none" data-bs-dismiss="modal" id="deleteRecord-close"><i class="ri-close-line me-1 align-middle"></i>
                                Close</button>
                          
                            <!-- <button class="btn btn-danger" id="delete-record">Yes, Delete It</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end modal -->

@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/timeline.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
