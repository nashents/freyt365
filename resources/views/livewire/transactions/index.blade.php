<div>
    <div class="row">
        <div>
             @include('includes.messages')
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#transactionModal" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New Transaction</a>
                  
                </div>
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Transaction#</th>
                                <th>Wallet</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>MOP</th>
                                <th>Currency</th>
                                <th>Amount</th>
                                <th>Charges</th>
                                <th>Auth</th>
                                <th>Verified/Declined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            @if (isset($transactions))
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td>{{$transaction->transaction_number}}</td>
                                        <td>{{$transaction->wallet ? $transaction->wallet->wallet_name : ""}}</td>
                                        <td>{{$transaction->transaction_date}}</td>
                                        <td>{{$transaction->transaction_type ? $transaction->transaction_type->name : ""}}</td>
                                        <td>{{$transaction->mop}}</td>
                                        <td>{{$transaction->currency ? $transaction->currency->name : ""}}</td>
                                        <td>{{$transaction->currency ? $transaction->currency->symbol : ""}}{{number_format($transaction->amount,2)}}</td>
                                        <td>
                                            @if ($transaction->charge_amount)
                                            {{$transaction->currency ? $transaction->currency->symbol : ""}}{{number_format($transaction->charge_amount,2)}} @ {{$transaction->charge ? $transaction->charge."%" : ""}}
                                            @else   
                                            {{$transaction->currency ? $transaction->currency->symbol : ""}}{{number_format(0,2)}}    
                                            @endif
                                        </td>
                                        <td><span class="badge bg-{{($transaction->authorization == 'approved') ? 'success' : (($transaction->authorization == 'rejected') ? 'danger' : 'warning') }}">{{($transaction->authorization == 'approved') ? 'approved' : (($transaction->authorization == 'rejected') ? 'rejected' : 'pending') }}</span></td>
                                        <td><span class="badge bg-{{($transaction->verification == 'verified') ? 'success' : (($transaction->verification == 'declined') ? 'danger' : 'warning') }}">{{($transaction->verification == 'verified') ? 'verified' : (($transaction->verification == 'declined') ? 'declined' : 'pending') }}</span></td>
                                        <td class="w-10 line-height-35 table-dropdown">
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @if (Auth::user()->is_admin() && $transaction->verification != "verified" && $transaction->authorization == "approved")
                                                    <li><a href="#" wire:click.prevent="showVerify({{$transaction->id}})"  class="dropdown-item"><i class="fa fa-refresh color-success"></i> Verify</a></li>
                                                    @endif
                                                   @if (Auth::user()->id == $transaction->user_id)
                                                    <li><a href="#" wire:click.prevent="edit({{$transaction->id}})" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li>
                                                   @endif
                                                   @if ($transaction->verification != "approved")
                                                    <li>
                                                        <a href="#" wire:click="delete({{$transaction->id}})"
                                                        wire:confirm="Are you sure you want to delete this transaction ?" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                    </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Transactions Found ....
                                                </div>
                                               
                                            </td>
                                        </tr>
                                    @endforelse
                            @endif
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->


    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="authorizationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Authorize Transaction </h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="saveAuthorize()" >
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom02">Approve/Reject<span class="required" style="color: red">*</span></label>
                            <select class="form-control" wire:model.live.debounce.300ms="authorization" required>
                                <option value="">Select Option</option>
                                <option value="approved">Approve</option>
                                <option value="rejected">Reject</option>
                            </select>
                            @error('authorization') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Reason</label>
                         <textarea class="form-control" wire:model.live.debounce.300ms="reason"
                         placeholder="Enter Reason" cols="30" rows="3"></textarea>
                                @error('reason') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-gray btn-wide btn-rounded" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i>Close</button>
                            <button type="submit" class="btn btn-outline-primary"><i class="fa fa-refresh "></i> Update</button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
   
    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="verificationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Verify Transaction </h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent = "saveVerify()">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom02">Verified/Declined<span class="required" style="color: red">*</span></label>
                            <select class="form-control" wire:model.live.debounce.300ms="verification" required>
                                <option value="">Select Option</option>
                                <option value="verified">Verified</option>
                                    <option value="declined">Declined</option>
                            </select>
                            @error('verification') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Reason</label>
                            <textarea class="form-control" wire:model.live.debounce.300ms="reason"
                            placeholder="Enter Reason" cols="30" rows="3"></textarea>
                            @error('reason') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-gray btn-wide btn-rounded" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i>Close</button>
                            <button type="submit" class="btn btn-outline-primary"><i class="fa fa-refresh "></i> Update</button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="transactionModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Add Transaction</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="store()" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Transaction Type<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="selectedType" required>
                                        <option value="">Select Type</option>
                                        @foreach ($transaction_types as $transaction_type)
                                            <option value="{{$transaction_type->name}}">{{$transaction_type->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedType') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                               </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">How did you pay?<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="mop" required>
                                        <option value="">Select Payment Method</option>
                                        @foreach ($to_bank_accounts as $to_bank_account)
                                            <option value="Bank Payment">Bank Payment</option>
                                            <option value="Cash">Cash</option>
                                            {{-- <option value="Credit Card">Credit Card</option>
                                            <option value="Other payment method">Other payment method</option> --}}
                                        @endforeach
                                    </select>
                                    @error('mop') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                               </div>
                        </div>
                      
                            @if (isset($mop) && $mop == "Bank Payment")
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom02">From Bank Accounts<span class="required" style="color: red">*</span></label>
                                            <select class="form-control" wire:model.live.debounce.300ms="selectedFrom" required>
                                                <option value="">Select Bank Account</option>
                                                @foreach ($from_bank_accounts as $from_bank_account)
                                                    <option value="{{$from_bank_account->id}}">{{$from_bank_account->name}} {{$from_bank_account->account_name}} {{$from_bank_account->account_number}}</option>
                                                @endforeach
                                            </select>
                                            @error('selectedFrom') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom02">To Bank Accounts<span class="required" style="color: red">*</span></label>
                                            <select class="form-control" wire:model.live.debounce.300ms="selectedTo" required>
                                                <option value="">Select Bank Account</option>
                                                @foreach ($to_bank_accounts as $to_bank_account)
                                                    <option value="{{$to_bank_account->id}}">{{$to_bank_account->name}} {{$from_bank_account->account_name}} {{$to_bank_account->account_number}}</option>
                                                @endforeach
                                            </select>
                                            @error('selectedTo') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif
                     
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Currencies<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="currency_id" required>
                                        <option value = "">Select Currency</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{$currency->id}}">{{$currency->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('currency_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Amount<span class="required" style="color: red">*</span></label>
                                    <input type="number" step="any" min="1" class="form-control" wire:model.live.debounce.300ms="amount"
                                        placeholder="Amount" required>
                                        @error('amount') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Transaction Date</label>
                                    <input type="date" class="form-control" wire:model.live.debounce.300ms="transaction_date"
                                        placeholder="Transaction Date">
                                        @error('transaction_date') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Reference</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="reference_code"
                                        placeholder="Reference">
                                        @error('reference_code') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-gray btn-wide btn-rounded" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i>Close</button>
                            <button type="submit" class="btn btn-outline-primary"><i class="fa fa-save"></i> Save</button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="transactionEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="fa fa-edit"></i> Edit Transaction</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="update()" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Transaction Type<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="selectedType" required>
                                        <option value="">Select Type</option>
                                        @foreach ($transaction_types as $transaction_type)
                                            <option value="{{$transaction_type->name}}">{{$transaction_type->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedType') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                               </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">How did you pay?<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="mop" required>
                                        <option value="">Select Payment Method</option>
                                        @foreach ($to_bank_accounts as $to_bank_account)
                                            <option value="Bank Payment">Bank Payment</option>
                                            <option value="Cash">Cash</option>
                                            {{-- <option value="Credit Card">Credit Card</option>
                                            <option value="Other payment method">Other payment method</option> --}}
                                        @endforeach
                                    </select>
                                    @error('mop') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                               </div>
                        </div>
                      
                            @if (isset($mop) && $mop == "Bank Payment")
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom02">From Bank Accounts<span class="required" style="color: red">*</span></label>
                                            <select class="form-control" wire:model.live.debounce.300ms="selectedFrom" required>
                                                <option value="">Select Bank Account</option>
                                                @foreach ($from_bank_accounts as $from_bank_account)
                                                    <option value="{{$from_bank_account->id}}">{{$from_bank_account->name}} {{$from_bank_account->account_name}} {{$from_bank_account->account_number}}</option>
                                                @endforeach
                                            </select>
                                            @error('selectedFrom') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom02">To Bank Accounts<span class="required" style="color: red">*</span></label>
                                            <select class="form-control" wire:model.live.debounce.300ms="selectedTo" required>
                                                <option value="">Select Bank Account</option>
                                                @foreach ($to_bank_accounts as $to_bank_account)
                                                    <option value="{{$to_bank_account->id}}">{{$to_bank_account->name}} {{$from_bank_account->account_name}} {{$to_bank_account->account_number}}</option>
                                                @endforeach
                                            </select>
                                            @error('selectedTo') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif
                     
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Currencies<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="currency_id" required>
                                        <option value = "">Select Currency</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{$currency->id}}">{{$currency->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('currency_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Amount<span class="required" style="color: red">*</span></label>
                                    <input type="number" step="any" min="1" class="form-control" wire:model.live.debounce.300ms="amount"
                                        placeholder="Amount" required>
                                        @error('amount') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Transaction Date</label>
                                    <input type="date" class="form-control" wire:model.live.debounce.300ms="transaction_date"
                                        placeholder="Transaction Date">
                                        @error('transaction_date') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Reference</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="reference_code"
                                        placeholder="Reference">
                                        @error('reference_code') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-gray btn-wide btn-rounded" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i>Close</button>
                            <button type="submit" class="btn btn-outline-primary"><i class="fa fa-refresh"></i> Update</button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->







</div>
