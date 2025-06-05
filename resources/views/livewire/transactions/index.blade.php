<div>
    <x-loading/>
    <div class="row">
        <div>
             {{-- @include('includes.messages') --}}
        </div>
        <div class="col-12">
            <div class="card">
                @if (!Auth::user()->company->is_admin())
                <div class="card-header">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#transactionModal" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New Transaction</a>
                </div>
                @endif
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Transaction#</th>
                                <th>Reference</th>
                                @if (Auth::user()->is_admin())
                                <th>Company</th>
                                @endif
                                <th>CreatedBy</th>
                                <th>Wallet</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Ccy</th>
                                <th>Amt</th>
                                @if (!Auth::user()->is_admin())
                                <th>Auth</th>     
                                @endif
                                <th>Verified/Declined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            @if (isset($transactions))
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td>{{$transaction->transaction_number}}</td>
                                        <td>{{$transaction->transaction_reference}}</td>
                                        @if (Auth::user()->is_admin())
                                        <td>{{$transaction->company ? $transaction->company->name : ""}}</td>
                                        @endif
                                        <td>{{$transaction->user ? $transaction->user->name : ""}} {{$transaction->user ? $transaction->user->surname : ""}}</td>
                                        <td>
                                            @if ($transaction->wallet)
                                                {{$transaction->wallet ? $transaction->wallet->name : ""}} <i>{{$transaction->wallet->default == True ? "Default Wallet" : ""}}     </i>   
                                            @endif
                                        </td>
                                        <td>{{Carbon\Carbon::parse($transaction->created_at)->format('Y-m-d')}}</td>
                                        <td>{{$transaction->transaction_type ? $transaction->transaction_type->name : ""}} {{$transaction->charge ? "Charges" : ""}}
                                            {{$transaction->mop ? " / ".$transaction->mop : ""}}
                                           
                                        </td>
                                        <td>{{$transaction->currency ? $transaction->currency->name : ""}}</td>
                                        <td>{{$transaction->currency ? $transaction->currency->symbol : ""}}{{number_format($transaction->amount,2)}}</td>
                                        @if (!Auth::user()->is_admin())
                                        <td><span class="badge bg-{{($transaction->authorization == 'approved') ? 'primary' : (($transaction->authorization == 'rejected') ? 'danger' : 'warning') }}">{{($transaction->authorization == 'approved') ? 'approved' : (($transaction->authorization == 'rejected') ? 'rejected' : 'pending') }}</span></td>
                                        @endif
                                        <td><span class="badge bg-{{($transaction->verification == 'verified') ? 'primary' : (($transaction->verification == 'declined') ? 'danger' : 'warning') }}">{{($transaction->verification == 'verified') ? 'verified' : (($transaction->verification == 'declined') ? 'declined' : 'pending') }}</span></td>
                                        <td class="w-10 line-height-35 table-dropdown">
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{route('transactions.show',$transaction->id)}}" class="dropdown-item"><i class="fa fa-eye color-success"></i> View</a></li>
                                                    @if (Auth::user()->is_admin() && $transaction->verification != "verified" && $transaction->authorization == "approved")
                                                    <li><a href="#" wire:click.prevent="showVerify({{$transaction->id}})"  class="dropdown-item"><i class="fa fa-refresh color-success"></i> Verify</a></li>
                                                    @endif
                                                    @if (!Auth::user()->company->is_admin())
                                                        @if (Auth::user()->id == $transaction->user_id)
                                                            @if ($transaction->verification == "pending")
                                                                <li><a href="#" wire:click.prevent="edit({{$transaction->id}})" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li>
                                                                <li>
                                                                    <a href="#" wire:click="delete({{$transaction->id}})"
                                                                    wire:confirm="Are you sure you want to delete this transaction ?" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a>
                                                                </li>
                                                            @endif
                                                        @endif
                                                       
                                                    @endif
                                                  
                                                </ul>
                                            </div>
                                    </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Transactions Found ....
                                                </div>
                                               
                                            </td>
                                        </tr>
                                    @endforelse
                            @endif
                        </tbody>
                    </table>
                      <nav class="text-center" style="float: right">
                                <ul class="pagination rounded-corners">
                                    @if (isset($transactions))
                                        {{ $transactions->links() }} 
                                    @endif 
                                </ul>
                            </nav>  

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
        <div class="modal-dialog  mw-100 w-50">
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
                                    <label class="form-label" for="validationCustom02">Wallets<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="selectedWallet" required>
                                        <option value = "">Select Wallet</option>
                                        @foreach ($wallets as $wallet)
                                            <option value="{{$wallet->id}}">{{$wallet->name}} {{$wallet->currency ? $wallet->currency->name : ""}} {{$wallet->currency ? "(".$wallet->currency->symbol.")" : ""}} <i>{{$wallet->default == True ? "Default Account" : ""}}</i></option>
                                        @endforeach
                                    </select>
                                    @error('selectedWallet') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Transaction Type<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="selectedTransactionType" required>
                                        <option value="">Select Type</option>
                                        @foreach ($transaction_types as $transaction_type)
                                            <option value="{{$transaction_type->id}}">{{$transaction_type->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedTransactionType') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                               </div>
                        </div>
                        @if (!is_null($selectedTransactionType))

                            @if (isset($selected_transaction_type) && $selected_transaction_type->name == "Deposit")
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">How did you pay?<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="selectedMop" required>
                                        <option value="">Select Payment Method</option>
                                        <option value="Bank Payment">Bank Payment</option>
                                        <option value="Cash">Cash</option>
                                    </select>
                                    @error('selectedMop') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            @elseif (isset($selected_transaction_type) && $selected_transaction_type->name == "Internal Transfer")
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Wallet Number<span class="required" style="color: red">*</span></label>
                                    <input type="text"  class="form-control" wire:model.live.lazy="receiving_wallet_number"
                                    placeholder="Enter Freyt365 Wallet Number" required>
                                    @error('receiving_wallet_number') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            @endif
                        @endif
                     
                            @if (isset($selectedMop) && $selectedMop == "Bank Payment")
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
                                            <small> <a href="{{ route('bank_accounts.index') }}" target="_blank"><i class="fa fa-plus-square-o"></i> New Bank Account</a></small> 
                                            @error('selectedFrom') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom02">To Bank Accounts<span class="required" style="color: red">*</span></label>
                                            <select class="form-control" wire:model.live.debounce.300ms="selectedTo" required>
                                                <option value="">Select Bank Account</option>
                                                @foreach ($to_bank_accounts as $to_bank_account)
                                                    <option value="{{$to_bank_account->id}}">{{$to_bank_account->name}} {{$to_bank_account->account_name}} {{$to_bank_account->account_number}}</option>
                                                @endforeach
                                            </select>
                                            @error('selectedTo') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif
                     
                        @if (isset($selected_transaction_type) && $selected_transaction_type->name == "Internal Transfer")
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Amount<span class="required" style="color: red">*</span></label>
                            <input type="number" step="any" min="1" class="form-control" wire:model.live.debounce.300ms="amount"
                                placeholder="Amount" required>
                                @error('amount') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                        @else
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Amount<span class="required" style="color: red">*</span></label>
                                    <input type="number" step="any" min="1" class="form-control" wire:model.live.debounce.300ms="amount"
                                        placeholder="Amount" required>
                                        @error('amount') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Transaction Date</label>
                                    <input type="date" class="form-control" wire:model.live.debounce.300ms="transaction_date"
                                        placeholder="Transaction Date">
                                        @error('transaction_date') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Reference</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="reference_code"
                                        placeholder="Reference">
                                        @error('reference_code') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>  
                        @endif
                      
                      
                
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

    <div id="transaction_confirmationModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="ri-information-line h1 text-info"></i>
                        <h4 class="mt-2">Wallet Confirmation !!</h4>
                        @if (isset($selected_receiving_wallet))
                        <p class="mt-3">You are trying to send {{$selected_receiving_wallet->currency ? $selected_receiving_wallet->currency->name : ""}} {{$selected_receiving_wallet->currency ? $selected_receiving_wallet->currency->symbol : ""}}{{number_format($amount ? $amount : 0,2)}} to {{$selected_receiving_wallet->name}} {{$selected_receiving_wallet->wallet_number}}.</p> 
                        @endif
                        <button type="button" class="btn btn-gray btn-wide btn-rounded" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i>Cancel</button>
                        <button type="button" wire:click="sendMoney" class="btn btn-info my-2" data-bs-dismiss="modal">Send</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="transactionEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="fa fa-edit"></i> Edit Transaction</h4>
                    <button type="button" class="btn-close btn-cl  $transaction->transaction_type_id =  $this->selectedTransactionType;ose-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="update()" >
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom02">Wallets<span class="required" style="color: red">*</span></label>
                            <select class="form-control" wire:model.live.debounce.300ms="selectedWallet" required>
                                <option value = "">Select Wallet</option>
                                @foreach ($wallets as $wallet)
                                    <option value="{{$wallet->id}}">{{$wallet->name}} {{$wallet->currency ? $wallet->currency->name : ""}} {{$wallet->currency ? "(".$wallet->currency->symbol.")" : ""}} <i>{{$wallet->default == True ? "Default Account" : ""}}</i></option>
                                @endforeach
                            </select>
                            @error('selectedWallet') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Transaction Type<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="selectedTransactionType" required>
                                        <option value="">Select Type</option>
                                        @foreach ($transaction_types as $transaction_type)
                                            <option value="{{$transaction_type->id}}">{{$transaction_type->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedTransactionType') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                               </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">How did you pay?<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="selectedMop" required>
                                        <option value="">Select Payment Method</option>
                                        <option value="Bank Payment">Bank Payment</option>
                                        <option value="Cash">Cash</option>
                                    </select>
                                    @error('selectedMop') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                               </div>
                        </div>
                      
                            @if (isset($selectedMop) && $selectedMop == "Bank Payment")
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
                                                    <option value="{{$to_bank_account->id}}">{{$to_bank_account->name}} {{$to_bank_account->account_name}} {{$to_bank_account->account_number}}</option>
                                                @endforeach
                                            </select>
                                            @error('selectedTo') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif
                     
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Amount<span class="required" style="color: red">*</span></label>
                                    <input type="number" step="any" min="1" class="form-control" wire:model.live.debounce.300ms="amount"
                                        placeholder="Amount" required>
                                        @error('amount') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Transaction Date</label>
                                    <input type="date" class="form-control" wire:model.live.debounce.300ms="transaction_date"
                                        placeholder="Transaction Date">
                                        @error('transaction_date') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
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
