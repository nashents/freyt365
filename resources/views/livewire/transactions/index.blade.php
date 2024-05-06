<div>
    <div class="row">
        <div>
            @include('includes.messages')
       </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="" data-bs-toggle="modal" data-bs-target="#transactionModal" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New Transaction</a>
                  
                </div>
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Transaction#</th>
                                <th>CreatedBy</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Ref#</th>
                                <th>Currency</th>
                                <th>Amount</th>
                                <th>Authorization</th>
                                <th>Verification</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                      
                            @if (isset($transactions))
                            @forelse ($transactions as $transaction)
                            <tr>
                                @php
                                    $from = App\Models\BankAccount::find($transaction->from);
                                    $to = App\Models\BankAccount::find($transaction->to);
                                @endphp
                                <td>{{$transaction->transaction_number}}</td>
                                <td>{{$transaction->user ? $transaction->user->name : ""}} {{$transaction->user ? $transaction->user->surname : ""}}</td>
                                <td>{{$transaction->type}}</td>
                                <td>{{$transaction->transaction_date}}</td>
                                <td>
                                    @if (isset($from))
                                        {{$from->name}} {{$from->account_name}} {{$from->account_number}}        
                                    @endif
                                </td>
                                <td>
                                    @if (isset($to))
                                        {{$to->name}} {{$to->account_name}} {{$to->account_number}}
                                    @endif
                                </td>
                                <td>{{$transaction->reference_code}}</td>
                                <td>{{$transaction->currency ? $transaction->currency->name : ""}}</td>
                                <td>{{$transaction->currency ? $transaction->currency->symbol : ""}}{{number_format($transaction->amount,2)}}</td>
                                <td><span class="label label-{{($transaction->authorization == 'approved') ? 'success' : (($transaction->authorization == 'rejected') ? 'danger' : 'warning') }}">{{($transaction->authorization == 'approved') ? 'approved' : (($transaction->authorization == 'rejected') ? 'rejected' : 'pending') }}</span></td>
                                <td><span class="label label-{{($transaction->verification == 'verified') ? 'success' : (($transaction->verification == 'declined') ? 'danger' : 'warning') }}">{{($transaction->verification == 'verified') ? 'verified' : (($transaction->verification == 'declined') ? 'declined' : 'pending') }}</span></td>
                                <td class="w-10 line-height-35 table-dropdown">
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" wire:click.prevent="showAuthorize({{$transaction->id}})" class="dropdown-item"><i class="fa fa-gavel color-success"></i> Authorize</a></li>
                                            @if ($transaction->authorization == "approved")
                                                <li><a href="#" wire:click.prevent="showVerify({{$transaction->id}})" class="dropdown-item"><i class="fa fa-search color-success"></i> Verify</a></li>
                                            @endif
                                            @if ($transaction->authorization == "pending")
                                                <li><a href="#" wire:click.prevent="edit({{$transaction->id}})" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li>
                                                <li>
                                                    <a href="#" wire:click="delete({{$transaction->id}})"
                                                    wire:confirm="Are you sure you want to delete this transaction?" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                            </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11">
                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                        No Wallet Transaction Found ....
                                    </div>
                                   
                                </td>
                            </tr>
                            @endforelse
                            @else  

                            <tr>
                                <td colspan="11">
                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                        No Wallet Transaction Found ....
                                    </div>
                                   
                                </td>
                            </tr>

                            @endif
                    
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->


    
<div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="transactionModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Create Transaction</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="store()" >
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Type<span class="required" style="color: red">*</span></label>
                               <select  class="form-control" wire:model.live.debounce.300ms="selectedType" required>
                                    <option value="">Select Transaction Type</option>
                                    <option value="deposit">Deposit</option>
                                    <option value="withdrawal">Withdrawal</option>
                               </select>
                               @error('selectedType') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Method Of payment<span class="required" style="color: red">*</span></label>
                               <select  class="form-control" wire:model.live.debounce.300ms="mop" required>
                                    <option value="">Select Method Of Payment</option>
                                    <option value="cash">Cash</option>
                                    <option value="transfer">Transfer</option>
                               </select>
                               @error('mop') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    
                    </div>
                    <div class="row">
                        @if ($mop == "cash")
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">From</label>
                               <select  class="form-control" wire:model.live.debounce.300ms="selectedFrom" disabled>
                                    <option value="">Select From Bank Account</option>
                                    @foreach ($from_bank_accounts as $bank_account)
                                        <option value="{{$bank_account->id}}">{{$bank_account->name}} {{$bank_account->account_name}} {{$bank_account->account_number}}</option>
                                    @endforeach
                               </select>
                               @error('selectedFrom') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @else
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">From<span class="required" style="color: red">*</span></label>
                               <select  class="form-control" wire:model.live.debounce.300ms="selectedFrom" required>
                                    <option value="">Select From Bank Account</option>
                                    @foreach ($from_bank_accounts as $bank_account)
                                        <option value="{{$bank_account->id}}">{{$bank_account->name}} {{$bank_account->account_name}} {{$bank_account->account_number}}</option>
                                    @endforeach
                               </select>
                               <small>  <a href="{{ route('bank_accounts.index') }}" target="_blank"><i class="ri-add-circle-line"></i> New Bank Account</a></small> 
                               @error('selectedFrom') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @endif
                       
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">To<span class="required" style="color: red">*</span></label>
                               <select  class="form-control" wire:model.live.debounce.300ms="selectedTo" required>
                                    <option value="">Select To Bank Account</option>
                                    @foreach ($to_bank_accounts as $bank_account)
                                        <option value="{{$bank_account->id}}">{{$bank_account->name}} {{$bank_account->account_name}} {{$bank_account->account_number}}</option>
                                    @endforeach
                               </select>
                               @error('selectedTo') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
              
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Currencies<span class="required" style="color: red">*</span></label>
                               <select  class="form-control" wire:model.live.debounce.300ms="currency_id" required disabled>
                                    <option value="">Select Currency</option>
                                    @foreach ($currencies as $currency)
                                        <option value="{{$currency->id}}">{{$currency->name}} </option>
                                    @endforeach
                               </select>
                               @error('currency_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @if ($selectedType == "deposit")
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Amount<span class="required" style="color: red">*</span></label>
                                <input type="number" step="any" min="0" class="form-control" wire:model.live.debounce.300ms="amount"
                                    placeholder="Enter amount" required>
                                    @error('amount') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @elseif ($selectedType == "withdrawal")
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Amount<span class="required" style="color: red">*</span></label>
                                <input type="number" step="any" min="{{$wallet_balance}}" class="form-control" wire:model.live.debounce.300ms="amount"
                                    placeholder="Enter amount" required>
                                    @error('amount') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @endif
                        
                        
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Transaction Date<span class="required" style="color: red">*</span></label>
                                <input type="date"  class="form-control" wire:model.live.debounce.300ms="transaction_date" 
                                    placeholder="Enter transaction date" required>
                                    @error('transaction_date') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Reference Code</label>
                                <input type="text" class="form-control" wire:model.live.debounce.300ms="reference_code"
                                    placeholder="Enter reference code" >
                                    @error('reference_code') <span class="error" style="color:red">{{ $message }}</span> @enderror
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

<div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="transactionEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title" id="primary-header-modalLabel"> <i class="fas fa-edit"></i> Edit Transaction</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="update()" >
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Type<span class="required" style="color: red">*</span></label>
                               <select  class="form-control" wire:model.live.debounce.300ms="type" required>
                                    <option value="">Select Transaction Type</option>
                                    <option value="Deposit">Deposit</option>
                                    <option value="Withdrawal">Withdrawal</option>
                               </select>
                               @error('type') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Method Of payment<span class="required" style="color: red">*</span></label>
                               <select  class="form-control" wire:model.live.debounce.300ms="mop" required>
                                    <option value="">Select Method Of Payment</option>
                                    <option value="cash">Cash</option>
                                    <option value="transfer">Transfer</option>
                               </select>
                               @error('mop') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    
                    </div>
                    <div class="row">
                        @if ($mop == "cash")
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">From</label>
                               <select  class="form-control" wire:model.live.debounce.300ms="from" disabled>
                                    <option value="">Select From Bank Account</option>
                                    @foreach ($from_bank_accounts as $bank_account)
                                        <option value="{{$bank_account->id}}">{{$bank_account->name}} {{$bank_account->account_name}} {{$bank_account->account_number}}</option>
                                    @endforeach
                               </select>
                               @error('from') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @else
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">From<span class="required" style="color: red">*</span></label>
                               <select  class="form-control" wire:model.live.debounce.300ms="from" required>
                                    <option value="">Select From Bank Account</option>
                                    @foreach ($from_bank_accounts as $bank_account)
                                        <option value="{{$bank_account->id}}">{{$bank_account->name}} {{$bank_account->account_name}} {{$bank_account->account_number}}</option>
                                    @endforeach
                               </select>
                               <small>  <a href="{{ route('bank_accounts.index') }}" target="_blank"><i class="ri-add-circle-line"></i> New Bank Account</a></small> 
                               @error('from') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @endif
                       
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">To<span class="required" style="color: red">*</span></label>
                               <select  class="form-control" wire:model.live.debounce.300ms="to" required>
                                    <option value="">Select To Bank Account</option>
                                    @foreach ($to_bank_accounts as $bank_account)
                                        <option value="{{$bank_account->id}}">{{$bank_account->name}} {{$bank_account->account_name}} {{$bank_account->account_number}}</option>
                                    @endforeach
                               </select>
                               @error('to') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
              
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Currencies<span class="required" style="color: red">*</span></label>
                               <select  class="form-control" wire:model.live.debounce.300ms="currency_id" required>
                                    <option value="">Select Currency</option>
                                    @foreach ($currencies as $currency)
                                        <option value="{{$currency->id}}">{{$currency->name}} </option>
                                    @endforeach
                               </select>
                               @error('currency_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Amount<span class="required" style="color: red">*</span></label>
                                <input type="number" step="any" min="0" class="form-control" wire:model.live.debounce.300ms="amount"
                                    placeholder="Enter amount" required>
                                    @error('amount') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Transaction Date<span class="required" style="color: red">*</span></label>
                                <input type="date"  class="form-control" wire:model.live.debounce.300ms="transaction_date" 
                                    placeholder="Enter transaction date" required>
                                    @error('transaction_date') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Reference Code</label>
                                <input type="text" class="form-control" wire:model.live.debounce.300ms="reference_code"
                                    placeholder="Enter reference code" >
                                    @error('reference_code') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-gray btn-wide btn-rounded" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i>Close</button>
                        <button type="submit" class="btn btn-outline-primary"><i class="fas fa-refresh"></i>Update</button>
                    </div>
                    <!-- /.btn-group -->
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    
<div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="authorizationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title" id="primary-header-modalLabel"> <i class="fas fa-gavel"></i> Authorize Transaction</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="saveAuthorization()" >
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="validationCustom01">Authorize<span class="required" style="color: red">*</span></label>
                       <select  class="form-control" wire:model.live.debounce.300ms="authorization" required>
                            <option value="">Select Option</option>
                            <option value="approved">Approve</option>
                            <option value="rejected">Reject</option>
                       </select>
                       @error('authorization') <span class="error" style="color:red">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="validationCustom01">Reason</label>
                      <textarea class="form-control" wire:model.live.debounce.300ms="reason" cols="30" rows="4"></textarea>
                       @error('reason') <span class="error" style="color:red">{{ $message }}</span> @enderror
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

<div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="verificationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-search"></i> Verify Transaction</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="saveVerification()" >
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="validationCustom01">Verify<span class="required" style="color: red">*</span></label>
                       <select  class="form-control" wire:model.live.debounce.300ms="verification" required>
                            <option value="">Select Option</option>
                            <option value="verified">Verified</option>
                            <option value="declined">Declined</option>
                       </select>
                       @error('verification') <span class="error" style="color:red">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="validationCustom01">Reason</label>
                      <textarea class="form-control" wire:model.live.debounce.300ms="verification_reason" cols="30" rows="4"></textarea>
                       @error('verification_reason') <span class="error" style="color:red">{{ $message }}</span> @enderror
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


