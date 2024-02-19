@extends('layouts.master')
@section('title') @lang('translation.products') @endsection
@section('css')
<!--datatables css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') <a href="{{ route('product.index') }}">Products</a> @endslot
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
                    <h4 class="card-title mb-0 flex-grow-1">Products</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            @can('product-create')
                                <a href="{{ route('product.create') }}" >
                                <button type="button" class="btn btn-md btn-primary">
                                    <i class="ri-add-line align-middle me-1"></i>Add Product
                                </button>
                                </a>
                            @endcan
                            <button type="button" class="btn btn-secondary position-relative" data-bs-toggle="offcanvas" href="#offcanvasExample">
                                    <i class="ri-filter-3-line align-bottom me-1"></i> Filters
                                    @if(request()->has('sp_min') && request()->has('sp_max') && request()->has('pp_min') && request()->has('pp_max'))
                                        <span class="badge bg-danger border border-light p-1 position-absolute rounded-circle start-100 top-0 translate-middle"><span class="visually-hidden">unread messages</span></span>
                                    @endif
                            </button>

                            <button type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-soft-info">Export</button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                    <li><a class="dropdown-item " href="#" id="ExportReporttoCopy">Copy</a></li>
                                    <li><a class="dropdown-item" href="#" id="ExportReporttoCsv">Csv</a></li>
                                    <li><a class="dropdown-item" href="#" id="ExportReporttoExcel">Excel</a></li>
                                    <li><a class="dropdown-item" href="#" id="ExportReporttoPdf">Pdf</a></li>
                                    <li><a class="dropdown-item" href="#" id="ExportReporttoPrint">Print</a></li>
                                </ul>
                        </div>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row">
                            <table id="product-datatables" class="table table-bordered dt-responsive nowrap table-striped align-middle mt-3" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>SKU Number</th>
                                    <th>HSN / SAC Code</th>
                                    <th>Unit</th>
                                    <th>Selling Price</th>
                                    <th>Cost Price</th>
                                    <th>Stock In Hand</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>SKU Number</th>
                                    <th>HSN / SAC Code</th>
                                    <th>Unit</th>
                                    <th>Selling Price</th>
                                    <th>Cost Price</th>
                                    <th>Stock In Hand</th>
                                    <th>Actions</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($data as $key => $product)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sku_number }}</td>
                                        <td>{{ $product->hsn_code }} - {{ $product->sac_code }}</td>
                                        <td>{{ $product->unit }}</td>
                                        <td>{{ ($product->currencysym->symbol ?? '₹') .' '. $product->selling_price }}</td>
                                        <td>{{ ($product->currencysym->symbol ?? '₹') .' '. $product->cost_price }}</td>
                                        <td>@if($product->track_inventry){{ $product->stock_in_hand }} @else - @endif</td>
                                        <td>
                                            @can('product-edit')
                                                <a class="btn btn-sm btn-primary" href="{{ route('product.edit',$product->id) }}">Edit</a>
                                            @endcan
                                            @can('product-delete')
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['product.destroy', $product->id], 'style' => 'display:inline']) !!}
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

                    
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample"
                        aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header bg-light">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Product Fliters</h5>
                            <button type="button" class="btn-close text-reset"
                                data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <!--end offcanvas-header-->
                        <form action="" class="d-flex flex-column justify-content-end h-100">
                            <div class="offcanvas-body">
                                
                                <div class="mb-4">
                                    <label for="selling_price"
                                        class="form-label text-muted text-uppercase fw-semibold mb-3">Selling Price</label>
                                    <div class="row g-2 align-items-center">
                                        <div class="col-lg">
                                            <input type="number" class="form-control" id="selling_price" name="sp_min" 
                                                value="{{ request()->get('sp_min') ?? ''}}"  placeholder="0">
                                        </div>
                                        <div class="col-lg-auto">
                                            To
                                        </div>
                                        <div class="col-lg">
                                            <input type="number" class="form-control" id="selling_price" name="sp_max"
                                                value="{{ request()->get('sp_max') ?? ''}}"  placeholder="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="purchase_price"
                                        class="form-label text-muted text-uppercase fw-semibold mb-3">Purchase Price</label>
                                    <div class="row g-2 align-items-center">
                                        <div class="col-lg">
                                            <input type="number" class="form-control" id="purchase_price" name="pp_min"
                                                value="{{ request()->get('pp_min') ?? ''}}"   placeholder="0">
                                        </div>
                                        <div class="col-lg-auto">
                                            To
                                        </div>
                                        <div class="col-lg">
                                            <input type="number" class="form-control" id="purchase_price" name="pp_max" 
                                                value="{{ request()->get('pp_max') ?? ''}}"   placeholder="0">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end offcanvas-body-->
                            <div class="offcanvas-footer border-top p-3 text-center hstack gap-2">
                                <button class="btn btn-light w-100" onclick="clearFilters()" >Clear Filter</button>
                                <button type="submit" class="btn btn-success w-100">Apply</button>
                            </div>
                            <!--end offcanvas-footer-->
                        </form>
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
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script>    

    let table = new DataTable('#product-datatables', {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print', 'pdf'
        ]
    });

    $(".buttons-copy").hide();
    $(".buttons-csv").hide();
    $(".buttons-excel").hide();
    $(".buttons-print").hide();
    $(".buttons-pdf").hide();

    $("#ExportReporttoCopy").on("click", function() {
        table.button( '.buttons-copy' ).trigger();
    });
    $("#ExportReporttoCsv").on("click", function() {
        table.button( '.buttons-csv' ).trigger();
    });
    $("#ExportReporttoExcel").on("click", function() {
        table.button( '.buttons-excel' ).trigger();
    });
    $("#ExportReporttoPrint").on("click", function() {
        table.button( '.buttons-print' ).trigger();
    });
    $("#ExportReporttoPdf").on("click", function() {
        table.button( '.buttons-pdf' ).trigger();
    });

    // $("#product-datatables tfoot th").each( function ( i ) {
		
	// 	if ($(this).text() !== '') {
	//         var isStatusColumn = (($(this).text() == 'Status') ? true : false);
	// 		var select = $('<select><option value=""></option></select>')
	//             .appendTo( $(this).empty() )
	//             .on( 'change', function () {
	//                 var val = $(this).val();
					
	//                 table.column( i )
	//                     .search( val ? '^'+$(this).val()+'$' : val, true, false )
	//                     .draw();
	//             } );
	 		
	// 		// Get the Status values a specific way since the status is a anchor/image
	// 		if (isStatusColumn) {
	// 			var statusItems = [];
				
    //             /* ### IS THERE A BETTER/SIMPLER WAY TO GET A UNIQUE ARRAY OF <TD> data-filter ATTRIBUTES? ### */
	// 			table.column( i ).nodes().to$().each( function(d, j){
	// 				var thisStatus = $(j).attr("data-filter");
	// 				if($.inArray(thisStatus, statusItems) === -1) statusItems.push(thisStatus);
	// 			} );
				
	// 			statusItems.sort();
								
	// 			$.each( statusItems, function(i, item){
	// 			    select.append( '<option value="'+item+'">'+item+'</option>' );
	// 			});

	// 		}
    //         // All other non-Status columns (like the example)
	// 		else {
	// 			table.column( i ).data().unique().sort().each( function ( d, j ) {  
	// 				select.append( '<option value="'+d+'">'+d+'</option>' );
	// 	        } );	
	// 		}
	        
	// 	}
    // } );


    function clearFilters() {
    var url = new URL(window.location.href);
    url.search = '';
    setTimeout(function() {
        window.location.href = url.href;
    }, 100);  // Delay in milliseconds
}

</script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
