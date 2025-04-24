<div>
    <x-loading/>
    <div class="row">
        <div>
             @include('includes.messages')
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#bank_accountModal" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New Bank Account</a>
                </div>
                <div class="card-body">
                    <blockquote>
                        @if (Auth::user()->is_admin())
                        These are are your bank accounts that you use to tranfer funds into our accounts inorder to load money into your freyt365 wallet.
                        @else
                        These are are freyt365 bank accounts that transporters will use to tranfer funds into inorder to load money into their freyt365 wallets.
                        @endif
                       
                    </blockquote>
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Country</th>
                                <th>Bank</th>
                                <th>Acc Name</th>
                                <th>Acc #</th>
                                <th>Currency</th>
                                <th>Branch</th>
                                <th>Branch Code</th>
                                <th>Swift Code</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            @if (isset($bank_accounts))
                                @forelse ($bank_accounts as $bank_account)
                                    <tr>
                                        <td>{{$bank_account->country ? $bank_account->country->name : ""}}</td>
                                        <td>{{$bank_account->name}}</td>
                                        <td>{{$bank_account->account_name}}</td>
                                        <td>{{$bank_account->account_number}}</td>
                                        <td>{{$bank_account->currency ? $bank_account->currency->name : ""}}</td>
                                        <td>{{$bank_account->branch}}</td>
                                        <td>{{$bank_account->branch_code}}</td>
                                        <td>{{$bank_account->swift_code}}</td>
                                        <td><span class="badge bg-{{$bank_account->status == 1 ? "primary" : "danger"}}">{{$bank_account->status == 1 ? "Active" : "Inactive"}}</span></td>
                                        <td class="w-10 line-height-35 table-dropdown">
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#" wire:click.prevent="edit({{$bank_account->id}})" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li>
                                                    <li>
                                                        <a href="#" wire:click="delete({{$bank_account->id}})"
                                                        wire:confirm="Are you sure you want to delete this bank account?" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                    </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Bank Accounts Found ....
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


    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="bank_accountModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Add Bank Account</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="store()" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Countries<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="country_id" required>
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>                                      
                                        @endforeach
                                    </select>
                                        @error('country_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Bank Name<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="name"
                                        placeholder="Bank name" required>
                                        @error('name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                           <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom02">Currencies<span class="required" style="color: red">*</span></label>
                                <select class="form-control" wire:model.live.debounce.300ms="currency_id" required>
                                    <option value="">Select Currency</option>
                                    @foreach ($currencies as $currency)
                                    <option value="{{ $currency->id }}">{{ $currency->name }} ({{ $currency->symbol }}) {{ $currency->fullname }}</option>                                      
                                    @endforeach
                                </select>
                                @error('currency_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                           </div>
                          
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Account Name</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="account_name"
                                        placeholder="Bank name" >
                                        @error('account_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Account Number</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="account_number"
                                        placeholder="Account Number" >
                                        @error('account_number') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Branch Name</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="branch"
                                        placeholder="Branch name" >
                                        @error('branch') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Branch Code</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="branch_code"
                                        placeholder="Branch Code" >
                                        @error('branch_code') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Swift Code</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="swift_code"
                                        placeholder="Swift Code" >
                                        @error('swift_code') <span class="error" style="color:red">{{ $message }}</span> @enderror
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

    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="bank_accountEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="fa fa-edit"></i> Edit Bank Account</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="update()" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Countries<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="country_id" required>
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>                                      
                                        @endforeach
                                    </select>
                                        @error('country_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Bank Name<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="name"
                                        placeholder="Bank name" required>
                                        @error('name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                           <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom02">Currencies<span class="required" style="color: red">*</span></label>
                                <select class="form-control" wire:model.live.debounce.300ms="currency_id" required>
                                    <option value="">Select Currency</option>
                                    @foreach ($currencies as $currency)
                                    <option value="{{ $currency->id }}">{{ $currency->name }} ({{ $currency->symbol }}) {{ $currency->fullname }}</option>                                      
                                    @endforeach
                                </select>
                                @error('currency_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                           </div>
                          
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Account Name</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="account_name"
                                        placeholder="Bank name" >
                                        @error('account_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Account Number</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="account_number"
                                        placeholder="Account Number">
                                        @error('account_number') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Branch Name</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="branch"
                                        placeholder="Branch name" >
                                        @error('branch') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Branch Code</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="branch_code"
                                        placeholder="Branch Code" >
                                        @error('branch_code') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Swift Code</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="swift_code"
                                        placeholder="Swift Code" >
                                        @error('swift_code') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-gray btn-wide btn-rounded" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i>Close</button>
                            <button type="submit" class="btn btn-outline-primary"><i class="fa fa-refresh"></i>Update</button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->







</div>
