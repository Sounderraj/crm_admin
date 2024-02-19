@extends('layouts.master')
@section('title') @lang('translation.salesorder') @endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') <a href="{{ route('vendors.index') }}">@lang('translation.salesorder')</a> @endslot        
        @slot('title') Add @endslot
    @endcomponent

<div class="row justify-content-center">
    <div class="col-xxl-12">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <form action="{{ route('orders.store') }}" method="post" class="needs-validation" novalidate id="invoice_form">
                @csrf
                <div class="card-body border-bottom border-bottom-dashed p-4">
                    <div class="row mb-3">
                        <div class="col-sm-6 form-group">
                            <label for="name">Customer Name</label> <span class="text-danger">*</span>
                            <select name="vendors_id" id="vendors_id" class="form-control js-example-basic-single select2-hidden-accessible" required>
                                <option value="" disabled selected>Select vendors name</option>
                                @foreach($vendors as $val)
                                    <option value="{{ $val->id }}">{{ $val->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="name">Sale order number</label> <span class="text-danger">*</span>
                            <input type="text" name="sale_order_id" id="sale_order_id" class="form-control" placeholder="Sale order number" value="{{$nextsaleordernum}}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6 form-group">
                            <label for="name">Reference</label> 
                            <input type="text" name="reference_num" id="reference_num" class="form-control" placeholder="Reference number">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="name">Sale Order Date</label> 
                            <input type="date" name="saleorder_date" id="saleorder_date" data-provider="flatpickr" data-date-format="d-m-Y" data-deafult-date="{{date('d-m-Y')}}" 
                            class="form-control" placeholder="Reference number" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-6 form-group">
                            <label for="name">Place of Supply</label> 
                            <select name="place_of_supply" id="place_of_supply" class="form-control js-example-basic-single select2-hidden-accessible" required>
                                @foreach($pos as $val)
                                    <option value="{{ $val->id }}" data-intra_state="{{ $val->intra_state }}">{{ '['.$val->short_code.'] - '.$val->name  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- <div class="row mb-3">
                       
                    </div>
                    <div class="row mb-3">
                       
                    </div> -->
                    <!--end row-->
                </div>

                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="invoice-table table table-borderless table-nowrap mb-0">
                            <thead class="align-middle">
                                <tr class="table-active">
                                    <th scope="col" style="width: 50px;">#</th>
                                    <th scope="col">
                                        Product Details
                                    </th>
                                    <th scope="col" style="width: 120px;">
                                        <div class="d-flex currency-select input-light align-items-center">
                                            Rate
                                            <select class="form-selectborder-0 bg-light" data-choices data-choices-search-false id="choices-payment-currency" onchange="otherPayment()">
                                                <option value="₹">(₹)</option>
                                            </select>
                                        </div>
                                    </th>
                                    <th scope="col" style="width: 120px;">Quantity</th>
                                    <th scope="col" style="width: 120px;">Tax</th>
                                    <th scope="col" style="width: 150px;">Amount</th>
                                    <th scope="col" class="text-end" style="width: 105px;"></th>
                                </tr>
                            </thead>
                            <tbody id="newlink">
                                <tr id="1" class="product">
                                    <th scope="row" class="product-id">1</th>
                                    <td class="text-start">
                                        <div class="mb-2">
                                            <!-- <input type="text" class="form-control bg-light border-0" id="productName-1" placeholder="Product Name" required /> -->
                                            <select name="product_id" id="productName-1" class="form-control js-example-basic-single select2-hidden-accessible" required onchange="getProductDetails(1)">
                                                <option value="" disabled selected>Please select a product name</option>
                                                @foreach($products as $val)
                                                    <option value="{{ $val->id }}">{{ $val->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a product name
                                            </div>
                                        </div>
                                        <!-- <textarea class="form-control bg-light border-0" id="productDetails-1" rows="2" placeholder="Product Details"></textarea> -->
                                    </td>
                                    <td>
                                        <input type="number" class="form-control product-price bg-light border-0" id="productRate-1" step="0.01" placeholder="0.00" required readonly/>
                                        <div class="invalid-feedback">
                                            Please enter a rate
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <div class="input-step">
                                            <button type="button" class='minus'>–</button>
                                            <input type="number" class="product-quantity" id="product-qty-1" value="0" min="0" readonly>
                                            <button type="button" class='plus'>+</button>
                                        </div>
                                    </td>
                                    <td>
                                        <select name="product_tax_id" id="productTax-1" class="product-tax form-control js-example-basic-single select2-hidden-accessible" required onchange="getProductDetails(1)">
                                            <!-- <option value="" disabled selected></option> -->
                                            @foreach($tax_pref as $val)
                                                <option value="{{ $val }}">{{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-end">
                                        <div>
                                            <input type="text" class="form-control bg-light border-0 product-line-price" id="productPrice-1" placeholder="0.00" readonly />
                                        </div>
                                    </td>
                                    <!-- <td class="product-removal">
                                        <a href="javascript:void(0)" class="btn btn-danger">Delete</a>
                                    </td> -->
                                    <!-- <td colspan="5">
                                        <a href="javascript:new_link()" id="add-item" class="btn btn-soft-primary fw-medium"><i class="ri-add-fill me-1 align-bottom"></i> Add Item</a>
                                    </td> -->
                                </tr>
                            </tbody>
                            <tbody>
                                <tr id="newForm" style="display: none;">
                                    <td class="d-none" colspan="5">
                                        <p>Add New Form</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <a href="javascript:new_link()" id="add-item" class="btn btn-soft-primary fw-medium"><i class="ri-add-fill me-1 align-bottom"></i> Add Item</a>
                                    </td>
                                </tr>
                                <tr class="border-top border-top-dashed mt-2">
                                    <td colspan="3"></td>
                                    <td colspan="2" class="p-0">
                                        <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Sub Total</th>
                                                    <td style="width:150px;">
                                                        <input type="text" class="form-control bg-light border-0" id="cart-subtotal" placeholder="0.00" readonly />
                                                    </td>
                                                </tr>
                                               
                                                <tr>
                                                    <th scope="row">Discount <small class="text-muted"></small></th>
                                                    <td>
                                                        <input type="text" class="form-control bg-light border-0" id="cart-discount" placeholder="0.00" readonly />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Estimated Tax </th>
                                                    <td>
                                                        <input type="text" class="form-control bg-light border-0" id="cart-tax" placeholder="0.00" readonly />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Shipping Charge</th>
                                                    <td>
                                                        <input type="text" class="form-control bg-light border-0" id="cart-shipping" placeholder="0.00" readonly />
                                                    </td>
                                                </tr>
                                                <tr class="border-top border-top-dashed">
                                                    <th scope="row">Total Amount</th>
                                                    <td>
                                                        <input type="text" name="total_amount" class="form-control bg-light border-0" id="cart-total" placeholder="0.00" readonly />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!--end table-->
                                    </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--end table-->
                    </div>
                   
                    <div class="row mt-3">
                        <div class="col-lg-5">
                            <div class="mt-4">
                                <label for="exampleFormControlTextarea1" class="form-label text-muted text-uppercase fw-semibold">Customer Notes</label>
                                <textarea class="form-control alert alert-primary" id="exampleFormControlTextarea1" placeholder="Customer Notes" rows="2" required name="vendors_notes" >All accounts are to be paid within 7 days from receipt of invoice. </textarea>
                            </div>
                        </div>
                    </div>

                    <div >
                        <div class="col-lg-5">
                            <div class="mt-3">
                                <label for="exampleFormControlTextarea1" class="form-label text-muted text-uppercase fw-semibold">Terms & Conditions</label>
                                <textarea class="form-control alert alert-primary" id="exampleFormControlTextarea1" placeholder="Terms & Conditions" rows="2" required name="terms_and_conditions">All accounts are to be paid within 7 days from receipt of invoice. To be paid by cheque or credit card or direct payment online. If account is not paid within 7 days the credits details supplied as confirmation of work undertaken will be charged the agreed quoted fee noted above.</textarea>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                    <div class="col-sm-10 mt-4 gap-4 text-end">
                        <button type="button" class="btn btn-light mx-3">
                            <a href="{{ route('orders.index')}}">Cancel</a>
                        </button>
                        <button type="submit" class="btn btn-success" >Save</button>
                    </div>

                    <!-- <div class="col-lg-9 hstack gap-2 justify-content-end d-print-none mt-4"> -->
                        <!-- <button type="submit" class="btn btn-primary"> -->
                            <!-- <i class="ri-printer-line align-bottom me-1"></i>  -->
                        <!-- Save</button> -->
                        <!-- <a href="javascript:void(0);" class="btn btn-primary"><i class="ri-download-2-line align-bottom me-1"></i> Download Invoice</a> -->
                        <!-- <a href="javascript:void(0);" class="btn btn-secondary"><i class="ri-send-plane-fill align-bottom me-1"></i> Send Invoice</a> -->
                    <!-- </div> -->
                </div>
            </form>
        </div>
    </div>
    <!--end col-->
</div>

@endsection
@section('script')
<script src="{{ URL::asset('build/js/pages/form-validation.init.js') }}"></script>
<!--jquery cdn-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script>
    var count=1;
    var BASE_URL = "{{env('APP_URL')}}";
	var subtotal = 0;
    var taxRate = 0.125;
    var shippingRate = 0;
    var discountRate = 0.15;

    </script>
<script src="{{ URL::asset('build/js/salesorder/main.js') }}"></script>
<script>
 isData();
 remove();
function new_link() {
    count++;
	var tr1 = document.createElement("tr");
	tr1.id = count;
	tr1.className = "product";

    var newForm = document.getElementById("newForm").innerHTML;
    var delLink = `
        <tr>
		<th scope="row" class="product-id">
		    ${count}
		</th>
        <td class="text-start">
            <div class="mb-2">
                <select name="product_id" id="productName-${count}" class="form-control js-example-basic-single select2-hidden-accessible" onchange="getProductDetails(${count})" required>
                    <option value="" disabled selected>Select product</option>
                    @foreach($products as $val)
                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Please select a product
                </div>
            </div>
            
        </td>
        <td>
            <input type="number" class="form-control product-price bg-light border-0" id="productRate-${count}" step="0.01" placeholder="$0.00" required readonly/>
            <div class="invalid-feedback">
                Please enter a rate
            </div>
        </td>
        <td>
            <div class="input-step">
                <button type="button" class="minus">–</button>
                <input type="number" class="product-quantity" id="product-qty-${count}" value="0" readonly>
                <button type="button" class="plus">+</button>
            </div>
        </td>
        
        <td class="text-end">
            <div>
                <select name="product_tax_id" id="productTax-${count}" class="product-tax form-control js-example-basic-single select2-hidden-accessible" required onchange="getProductDetails(${count})">
                    @foreach($tax_pref as $val)
                        <option value="{{ $val }}">{{ $val }}</option>
                    @endforeach
                </select>
            </div>
        </td>
        <td class="text-end">
            <div>
                <input type="text" class="form-control bg-light border-0 product-line-price" id="productPrice-${count}" placeholder="0.00" readonly />
            </div>
        </td>
       
        <td class="product-removal">
        <a class="btn btn-success">Delete</a>
        </td>
        </tr>`;

        tr1.innerHTML = document.getElementById("newForm").innerHTML + delLink;

        document.getElementById("newlink").appendChild(tr1);

    // Initialize select2 for the newly added select element
    $('.js-example-basic-single').select2();

    // Add event listeners to the new product rate input field
    document.getElementById("productRate-" + count).addEventListener("change", function () {
        amountKeyup(count);
    });

    // Add event listeners to the new product quantity input field
    document.getElementById("product-qty-" + count).addEventListener("change", function () {
        amountKeyup(count);
    });

    var genericExamples = document.querySelectorAll("[data-trigger]");
	Array.from(genericExamples).forEach(function (genericExamp) {
		var element = genericExamp;
		new Choices(element, {
			placeholderValue: "This is a placeholder set in the config",
			searchPlaceholderValue: "This is a search placeholder",
		});
	});

	isData();
	remove();
	amountKeyup();
	resetRow()

}

function getProductDetails(count) {
    // Get the selected product ID
    var productId = document.getElementById('productName-' + count).value;

    // Make an AJAX request to fetch the rate of the selected product
    var xhr = new XMLHttpRequest();
    xhr.open('get', BASE_URL+'web-apis/getProductDetails?id=' + productId, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Parse the response JSON
                var response = JSON.parse(xhr.responseText);

                // Update the rate field with the fetched rate
                document.getElementById('productRate-' + count).value = response.selling_price ?? 0;
                if(response.tax_preference == '')
                document.getElementById('productRate-' + count).value = response.selling_price ?? 0;
            } else {

                // Handle the error case
                console.error('Failed to fetch product rate');
            }
        }
    };

    // Send the AJAX request
    xhr.send();
}


</script>
@endsection
