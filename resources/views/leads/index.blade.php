@extends('layouts.master')
@section('title') @lang('translation.timeline') @endsection
@section('css')
<!--datatables css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') <a href="{{ route('leads.index') }}">Leads</a> @endslot
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
                    <h4 class="card-title mb-0 flex-grow-1">Leads</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            @can('leads-create')
                                <a href="{{ route('leads.create') }}" >
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
                                    <th>Name</th>
                                    <th>Title</th>
                                    <th>Company Name</th>
                                    <th>Phone</th>
                                    <th>Lead Status</th>
                                    <th>Lead Owner</th>
                                    <th>Lead Score</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $leads)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $leads->name }}</td>
                                        <td>{{ $leads->title }}</td>
                                        <td>{{ $leads->company_name }}</td>
                                        <td>{{ $leads->phone }}</td>
                                        <td>{{ $leads->leads_owner }}</td>
                                        <td>{{ $leads->leads_status }}</td>
                                        <td>{{ $leads->leads_score }}</td>
                                        <td>{{ $leads->created_at }}</td>
                                        <td>
                                            @can('leads-show')
                                                <a class="btn btn-sm btn-info" href="{{ route('leads.show',$leads->id) }}">Show</a>
                                            @endcan
                                            @can('leads-edit')
                                                <a class="btn btn-sm btn-primary" href="{{ route('leads.edit',$leads->id) }}">Edit</a>
                                            @endcan
                                            @can('leads-delete')
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['leads.destroy', $leads->id], 'style' => 'display:inline']) !!}
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="{{ URL::asset('build/js/pages/form-validation.init.js') }}"></script>

<script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
