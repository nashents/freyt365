<div>
    <x-loading/>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if (!Auth::user()->is_admin())
                <div class="card-header">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#walletModal" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> Wallet</a>
                </div> 
                @endif
               
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                @if (Auth::user()->is_admin())
                                <th>Company</th> 
                                @endif
                                <th>Account#</th>
                                <th>Name</th>
                                <th>Currency</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($wallets as $wallet)
                            <tr>
                                @if (Auth::user()->is_admin())
                                <td>{{$wallet->company ? $wallet->company->name : ""}}</td>
                                @endif
                                <td>{{$wallet->wallet_number}}</td>
                                <td>{{$wallet->name}} {{$wallet->default == True ? "(Default)" : ""}}</td>
                                <td>{{$wallet->currency ? $wallet->currency->name : ""}}</td>
                                <td>{{$wallet->currency ? $wallet->currency->symbol : ""}}{{number_format($wallet->balance ? $wallet->balance : 0,2)}}</td>
                                <td><span class="badge bg-{{$wallet->active == 1 ? "primary" : "danger"}}">{{$wallet->active == 1 ? "Active" : "Inactive"}}</span></td>
                                <td class="w-10 line-height-35 table-dropdown">
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{route('account_statement.index',['wallet_id'=> $wallet->id])}}"   class="dropdown-item"><i class="fa fa-file color-success"></i> Account Statement</a></li>
                                            @if (!Auth::user()->is_admin())
                                            <li><a href="#" wire:click.prevent="loadDeposit({{$wallet->id}})"  class="dropdown-item"><i class="fa fa-piggy-bank color-success"></i> Load Deposit</a></li>
                                            <li><a href="#" wire:click.prevent="edit({{$wallet->id}})" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li>
                                            @endif
                                            <li>
                                                <a href="#" wire:click="delete({{$wallet->id}})"
                                                wire:confirm="Are you sure you want to delete this wallet?" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->


    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="walletModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Add Wallet</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="store()" >
                    <div class="modal-body">
                            <blockquote>This option let`s you create a new wallet for your company. You can have multiple wallets based on your business needs eg. Wallet specifically for Tollfees.
                                If you intent to load funds to an existing wallet <a href="{{route('transactions.index')}}">click here</a>
                            </blockquote>
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Name<span class="required" style="color: red">*</span></label>
                            <input type="text"  class="form-control" wire:model.live.debounce.300ms="name"
                                placeholder="Wallet Name" required>
                                @error('name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Currency<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="currency_id" required>
                                        <option value="">Select Currency</option>
                                        @foreach ($currencies as $currency)
                                        <option value="{{ $currency->id }}">{{ $currency->name }} ({{ $currency->symbol }}) {{ $currency->fullname }}</option>                                      
                                        @endforeach
                                    </select>
                                    @error('currency_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Select Status<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="active" required>
                                        <option value="">Select Option</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @error('active') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-gray btn-wide btn-rounded" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i>Close</button>
                            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-floppy-fill"></i> Save</button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="walletEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Edit Wallet</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="update()" >
                    <div class="modal-body">
                        <blockquote>This option let`s you create a new wallet for your company. You can have multiple wallets based on your business needs eg. Wallet specifically for Tollfees.
                            If you intent to load funds to an existing wallet <a href="{{route('transactions.index')}}">click here</a>
                        </blockquote>
                    <div class="mb-3">
                        <label class="form-label" for="validationCustom01">Name<span class="required" style="color: red">*</span></label>
                        <input type="text"  class="form-control" wire:model.live.debounce.300ms="name"
                            placeholder="Wallet Name" required>
                            @error('name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Currency<span class="required" style="color: red">*</span></label>
                                <select class="form-control" wire:model.live.debounce.300ms="currency_id" required>
                                    <option value="">Select Currency</option>
                                    @foreach ($currencies as $currency)
                                    <option value="{{ $currency->id }}">{{ $currency->name }} ({{ $currency->symbol }}) {{ $currency->fullname }}</option>                                      
                                    @endforeach
                                </select>
                                @error('currency_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Select Status<span class="required" style="color: red">*</span></label>
                                <select class="form-control" wire:model.live.debounce.300ms="active" required>
                                    <option value="">Select Option</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('active') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                       
                    </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-gray btn-wide btn-rounded" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i>Close</button>
                            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-floppy-fill"></i> Update</button>
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
                <form wire:submit.prevent="deposit()" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Wallets<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="selectedWallet" required disabled>
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
                                    <select class="form-control" wire:model.live.debounce.300ms="selectedTransactionType" required disabled>
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

</div>
