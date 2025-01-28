<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#walletModal" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> Wallet</a>
                </div>
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
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
                                            <li><a href="#"   class="dropdown-item"><i class="fa fa-piggy-bank color-success"></i> Load Deposit</a></li>
                                            <li><a href="#"   class="dropdown-item"><i class="fa fa-file color-success"></i> Account Statement</a></li>
                                            <li><a href="#"   class="dropdown-item"><i class="fa fa-gavel color-success"></i> Activate</a></li>
                                            <li><a href="#"   class="dropdown-item"><i class="fa fa-edit color-primary"></i> Edit</a></li>
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
                            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-floppy-fill"></i> Update</button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>
