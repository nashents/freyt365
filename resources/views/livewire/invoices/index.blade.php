<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#invoiceModal" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New Invoice</a>
                  
                </div>
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Invoice#</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Due</th>
                                <th>Status</th>
                                <th>Currency</th>
                                <th>Total</th>
                                {{-- <th>Paid</th>
                                <th>Due</th> --}}
                                <th>Auth</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            @forelse ($invoices as $invoice)
                            @php
                                $expiry = $invoice->expiry;
                                $now = new DateTime();
                                $expiry_date = new DateTime($expiry);
                            @endphp
                          <tr>
                            <td>{{$invoice->invoice_number}}</td>
                            <td>
                                {{$invoice->customer ? $invoice->customer->name : ""}}
                            </td>
                            <td>{{$invoice->date}}</td>
                            <td><span class="label label-{{$now <= $expiry_date ? 'success' : 'danger' }}">{{$invoice->expiry}}</span></td>
                            <td><span class="label label-{{($invoice->status == 'Paid') ? 'success' : (($invoice->status == 'Partial') ? 'warning' : 'danger') }}">{{ $invoice->status }}</span></td>
                            <td>
                                {{$invoice->currency ? $invoice->currency->name : ""}}
                            </td>
                            <td>
                                @if ($invoice->total)
                                {{$invoice->currency ? $invoice->currency->symbol : ""}}{{number_format($invoice->total,2)}}
                                @endif
                            </td>
                            {{-- <td>
                                @if (isset($invoice->payments))
                                     {{$invoice->currency ? $invoice->currency->symbol : ""}}{{number_format($invoice->payments->sum('amount'),2)}}
                                @else
                                     {{$invoice->currency ? $invoice->currency->symbol : ""}}{{number_format($invoice->invoice_payments->sum('amount'),2)}}
                                @endif
                            </td>
                            <td>
                               
                                @if ($invoice->balance)
                                {{$invoice->currency ? $invoice->currency->symbol : ""}}{{number_format($invoice->balance,2)}}
                                @endif
                            </td> --}}
                            <td><span class="badge bg-{{($invoice->authorization == 'approved') ? 'success' : (($invoice->authorization == 'rejected') ? 'danger' : 'warning') }}">{{($invoice->authorization == 'approved') ? 'approved' : (($invoice->authorization == 'rejected') ? 'rejected' : 'pending') }}</span></td>
                           
                            <td class="w-10 line-height-35 table-dropdown">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bars"></i>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{route('invoices.show',$invoice->id)}}"  class="dropdown-item"><i class="fa fa-eye color-success"></i> Preview</a></li>
                                        <li><a href="#" wire:click.prevent="edit({{$invoice->id}})" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li>
                                        <li>
                                            <a href="#" wire:click="delete({{$invoice->id}})"
                                            wire:confirm="Are you sure you want to delete this invoice?" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a>
                                        </li>
                                    </ul>
                                </div>
                        </td>
                          </tr>
                          @empty
                          <tr>
                            <td colspan="9">
                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                    No Invoices Found ....
                                </div>
                               
                            </td>
                          </tr>  
                        @endforelse
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->

    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="invoiceModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Create Invoice</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="store()" >
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Invoice#</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="invoice_number"
                                        placeholder="Enter invoice number">
                                        @error('invoice_number') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                     
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Customer<span class="required" style="color: red">*</span></label>
                                   <select class="form-control" wire:model.live.debounce.300ms="selectedCustomer" required>
                                        <option value="">Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                                        @endforeach
                                   </select>
                                        @error('selectedCustomer') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Currencies<span class="required" style="color: red">*</span></label>
                                   <select class="form-control" wire:model.live.debounce.300ms="selectedCurrency" required>
                                        <option value="">Select Currency</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{$currency->id}}">{{$currency->name}}</option>
                                        @endforeach
                                   </select>
                                        @error('selectedCurrency') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                     
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Bank Accounts<span class="required" style="color: red">*</span></label>
                                   <select class="form-control" wire:model.live.debounce.300ms="bank_account_id" required>
                                        <option value="">Select Bank Account</option>
                                        @foreach ($bank_accounts as $bank_account)
                                            <option value="{{$bank_account->id}}">{{$bank_account->name}} {{$bank_account->account_name}} {{$bank_account->account_number}}</option>
                                        @endforeach
                                   </select>
                                        @error('bank_account_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            
                            </div>
                        </div>
                       
                   
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Invoice Date<span class="required" style="color: red">*</span></label>
                                    <input type="date" class="form-control" wire:model.live.debounce.300ms="date"
                                        placeholder="Enter from location" required>
                                </select>
                                        @error('date') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Invoice Due<span class="required" style="color: red">*</span></label>
                                        <input type="date" class="form-control" wire:model.live.debounce.300ms="expiry"
                                            placeholder="Enter invoice expiry" required>
                                       </select>
                                            @error('expiry') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">VAT</label>
                                        <input type="text" class="form-control" wire:model.live.debounce.300ms="vat"
                                            placeholder="Enter VAT" >
                                       </select>
                                            @error('vat') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                    
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Trips<span class="required" style="color: red">*</span></label>
                               <select class="form-control" wire:model.live.debounce.300ms="selectedTrip" multiple required>
                                    <option value="">Select Trip(s)</option>
                                    @foreach ($trips as $trip)
                                        <option value="{{$trip->id}}">{{$trip->trip_number}}  {{$trip->created_at->format('Y-m-d')}} | {{$trip->customer ? $trip->customer->name : ""}} | {{$trip->currency ? $trip->currency->name : ""}} {{$trip->currency ? $trip->currency->symbol : ""}}{{number_format($trip->freight ? $trip->freight : 0,2)}}</option>
                                    @endforeach
                               </select>
                                    @error('selectedTrip') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="date">Quantity<span class="required" style="color: red">*</span></label>
                                        <input type="number" min="1" max="1" class="form-control" wire:model.live.debounce.300ms="qty" placeholder="Enter Qty" required disabled>
                                        @error('qty') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                    </div>
                                </div>    
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="subheading">Invoice Amount<span class="required" style="color: red">*</span></label>
                                        <input type="number" step="any" class="form-control" wire:model.live.debounce.300ms="amount" placeholder="Enter Invoice Amount" required/>
                                        @error('amount') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                          
                        <div class="row">
                           
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Terms & Conditions</label>
                                    <textarea class="form-control" wire:model.live.debounce.300ms="memo" cols="30" rows="3" placeholder="Enter invoice memo/ terms & conditions"></textarea>
                                   </select>
                                        @error('memo') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Footer</label>
                                    <textarea class="form-control" wire:model.live.debounce.300ms="footer" cols="30" rows="3" placeholder="Enter invoice footer"></textarea>
                                   </select>
                                        @error('footer') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                    
                        </div>
                       
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-gray btn-wide btn-rounded" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i>Close</button>
                            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-floppy-fill"></i>Save</button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
 
    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="invoiceModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Create Invoice</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="store()" >
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Invoice#</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="invoice_number"
                                        placeholder="Enter invoice number">
                                        @error('invoice_number') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                     
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Customer<span class="required" style="color: red">*</span></label>
                                   <select class="form-control" wire:model.live.debounce.300ms="selectedCustomer" required>
                                        <option value="">Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                                        @endforeach
                                   </select>
                                        @error('selectedCustomer') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Currencies<span class="required" style="color: red">*</span></label>
                                   <select class="form-control" wire:model.live.debounce.300ms="selectedCurrency" required>
                                        <option value="">Select Currency</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{$currency->id}}">{{$currency->name}}</option>
                                        @endforeach
                                   </select>
                                        @error('selectedCurrency') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                     
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Bank Accounts<span class="required" style="color: red">*</span></label>
                                   <select class="form-control" wire:model.live.debounce.300ms="bank_account_id" required>
                                        <option value="">Select Bank Account</option>
                                        @foreach ($bank_accounts as $bank_account)
                                            <option value="{{$bank_account->id}}">{{$bank_account->name}} {{$bank_account->account_name}} {{$bank_account->account_number}}</option>
                                        @endforeach
                                   </select>
                                        @error('bank_account_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            
                            </div>
                        </div>
                       
                   
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Invoice Date<span class="required" style="color: red">*</span></label>
                                    <input type="date" class="form-control" wire:model.live.debounce.300ms="date"
                                        placeholder="Enter from location" required>
                                </select>
                                        @error('date') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Invoice Due<span class="required" style="color: red">*</span></label>
                                        <input type="date" class="form-control" wire:model.live.debounce.300ms="expiry"
                                            placeholder="Enter invoice expiry" required>
                                       </select>
                                            @error('expiry') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">VAT</label>
                                        <input type="text" class="form-control" wire:model.live.debounce.300ms="vat"
                                            placeholder="Enter VAT" >
                                       </select>
                                            @error('vat') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                    
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Trips<span class="required" style="color: red">*</span></label>
                               <select class="form-control" wire:model.live.debounce.300ms="selectedTrip" multiple required>
                                    <option value="">Select Trip(s)</option>
                                    @foreach ($trips as $trip)
                                        <option value="{{$trip->id}}">{{$trip->trip_number}}  {{$trip->created_at->format('Y-m-d')}} | {{$trip->customer ? $trip->customer->name : ""}} | {{$trip->currency ? $trip->currency->name : ""}} {{$trip->currency ? $trip->currency->symbol : ""}}{{number_format($trip->freight ? $trip->freight : 0,2)}}</option>
                                    @endforeach
                               </select>
                                    @error('selectedTrip') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="date">Quantity<span class="required" style="color: red">*</span></label>
                                        <input type="number" min="1" max="1" class="form-control" wire:model.live.debounce.300ms="qty" placeholder="Enter Qty" required disabled>
                                        @error('qty') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                    </div>
                                </div>    
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="subheading">Invoice Amount<span class="required" style="color: red">*</span></label>
                                        <input type="number" step="any" class="form-control" wire:model.live.debounce.300ms="amount" placeholder="Enter Invoice Amount" required/>
                                        @error('amount') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                          
                        <div class="row">
                           
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Terms & Conditions</label>
                                    <textarea class="form-control" wire:model.live.debounce.300ms="memo" cols="30" rows="3" placeholder="Enter invoice memo/ terms & conditions"></textarea>
                                   </select>
                                        @error('memo') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Footer</label>
                                    <textarea class="form-control" wire:model.live.debounce.300ms="footer" cols="30" rows="3" placeholder="Enter invoice footer"></textarea>
                                   </select>
                                        @error('footer') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                    
                        </div>
                       
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-gray btn-wide btn-rounded" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i>Close</button>
                            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-floppy-fill"></i>Save</button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>
