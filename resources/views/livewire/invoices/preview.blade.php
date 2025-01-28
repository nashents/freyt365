<div>
    <x-loading/>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <!-- Invoice Logo-->
                    <div class="clearfix">
                        <div class="float-start mb-3">
                            <img src="{{asset('images/uploads/'.$invoice->company->logo)}}" alt="dark logo" height="22">
                        </div>
                        <div class="float-end">
                            <h4 class="m-0 d-print-none">Invoice</h4>
                        </div>
                    </div>

                    <!-- Invoice Detail-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="fs-14">{{$invoice->company ? $invoice->company->name : ""}}</h6>
                            <address>
                                {{$invoice->company ? $invoice->company->street_address : ""}}<br>
                                {{$invoice->company ? $invoice->company->suburb : ""}}<br>
                                {{$invoice->company ? $invoice->company->city : ""}}, {{$invoice->company ? $invoice->company->country : ""}}<br>
                                <abbr title="Phone">P:</abbr> {{$invoice->company ? $invoice->company->phonenumber : ""}}
                            </address>

                        </div><!-- end col -->
                        <div class="col-sm-4 offset-sm-2">
                            <div class="mt-3 float-sm-end">
                                <p class="fs-13"><strong>Invoice Date: </strong> &nbsp;&nbsp;&nbsp; {{$invoice->date}}</p>
                                <p class="fs-13"><strong>Invoice Status: </strong> <span class="badge bg-success float-end">{{$invoice->status}}</span></p>
                                <p class="fs-13"><strong>Invoice Number: </strong> <span class="float-end">{{$invoice->invoice_number}}</span></p>
                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row mt-4">
                        <div class="col-6">
                            <h6 class="fs-14">BILL TO</h6>
                            <address>
                               {{$invoice->customer ? $invoice->customer->name : ""}}<br>
                                795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                <abbr title="Phone">P:</abbr> (123) 456-7890
                            </address>
                        </div> <!-- end col-->

                        {{-- <div class="col-6">
                            <h6 class="fs-14">Shipping Address</h6>
                            <address>
                                Thomson<br>
                                795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                <abbr title="Phone">P:</abbr> (123) 456-7890
                            </address>
                        </div> <!-- end col--> --}}
                    </div>    
                    <!-- end row -->        

                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-sm table-centered table-hover table-borderless mb-0 mt-3">
                                    <thead class="border-top border-bottom bg-light-subtle border-light">
                                    <tr><th>Description</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total(Excl)</th>
                                        <th>VAT</th>
                                        <th class="text-end">Total(Incl)</th>
                                    </tr></thead>
                                    <tbody>
                                        @foreach ($invoice->invoice_items as $item)
                                        <tr>
                                            <td>
                                                {{$item->trip_details}}
                                            </td>
                                            <td>{{$item->qty}}</td>
                                            <td>{{$invoice->currency ? $invoice->currency->symbol : ""}}{{number_format($item->amount,2)}}</td>
                                            <td>{{$invoice->currency ? $invoice->currency->symbol : ""}}{{number_format($item->subtotal,2)}}</td>
                                            <td>{{$invoice->vat ? $invoice->vat : 0}}%</td>
                                            <td class="text-end">{{$invoice->currency ? $invoice->currency->symbol : ""}}{{number_format($item->subtotal_incl,2)}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="clearfix pt-3">
                                <h6 class="text-muted fs-14">Notes:</h6>
                                <small>
                                    {{$invoice->memo}}
                                    <br>
                                    @if ($invoice->bank_account)
                                        <strong>Bank: </strong>{{$invoice->bank_account->name}}   <br>                                     
                                        <strong>Account Name: </strong>{{$invoice->bank_account->account_name}}  <br>                                  
                                        <strong>Account Number: </strong>{{$invoice->bank_account->account_number}}  <br>                                      
                                        <strong>Branch: </strong>{{$invoice->bank_account->branch}}  <br>                  
                                        <strong>Branch Code: </strong>{{$invoice->bank_account->branch_code}}  <br>                                        
                                        <strong>Swift Code: </strong>{{$invoice->bank_account->swift_code}}                                 
                                    @endif
                                </small>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-sm-6">
                            <div class="float-end mt-3 mt-sm-0">
                                <p><b>Sub-total:</b> <span class="float-end">{{$invoice->currency ? $invoice->currency->symbol : ""}}{{number_format($invoice->subtotal,2)}}</span></p>
                                <p><b>VAT ({{$invoice->vat ? $invoice->vat : 0}}):</b> <span class="float-end">{{$invoice->currency ? $invoice->currency->symbol : ""}}{{number_format($invoice->vat_amount,2)}}</span></p>
                                <h3>{{$invoice->currency ? $invoice->currency->symbol : ""}}{{number_format($invoice->total,2)}} {{$invoice->currency ? $invoice->currency->name : ""}}</h3>
                            </div>
                            <div class="clearfix"></div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row-->

                    <div class="d-print-none mt-4">
                        <div class="text-center">
                            <a href="javascript:window.print()" class="btn btn-primary"><i class="ri-printer-line"></i> Print</a>
                        </div>
                    </div>   
                    <!-- end buttons -->

                </div> <!-- end card-body-->
            </div> <!-- end card -->
        </div> <!-- end col-->
    </div>
</div>
