<div>
    <x-loading/>
    <div class="row">
        <div>
             @include('includes.messages')
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#overdraftModal" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New Wallet Overdraft</a>
                  
                </div>
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>Wallet</th>
                                <th>Limit</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            @if (isset($overdrafts))
                                @forelse ($overdrafts as $overdraft)
                                    <tr>
                                        <td>{{$overdraft->company ? $overdraft->company->name : ""}}</td>
                                        <td>{{$overdraft->wallet ? $overdraft->wallet->name : ""}}</td>
                                        <td>{{number_format($overdraft->limit ? $overdraft->limit : 0,2)}}</td>  
                                         <td><span class="badge bg-{{$overdraft->is_active == 1 ? "primary" : "danger"}}">{{$overdraft->is_active == 1 ? "Active" : "Inactive"}}</span></td>              
                                        <td class="w-10 line-height-35 table-dropdown">
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#" wire:click.prevent="edit({{$overdraft->id}})" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li>
                                                    <li>
                                                        <a href="#" wire:click="delete({{$overdraft->id}})"
                                                        wire:confirm="Are you sure you want to delete this wallet overdraft?" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                    </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Wallet Overdrafts Found ....
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


    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="overdraftModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Add Wallet Overdraft</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="store()" >
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom02">Companies<span class="required" style="color: red">*</span></label>
                            <select class="form-control" wire:model.live.debounce.300ms="selectedCompany" required>
                                <option value="">Select </option>
                                @foreach ($companies as $company)
                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            </select>
                            @error('selectedCompany') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom02">Wallets<span class="required" style="color: red">*</span></label>
                            <select class="form-control" wire:model.live.debounce.300ms="wallet_id" required>
                                <option value="">Select Wallet </option>
                                @foreach ($wallets as $wallet)
                                    <option value="{{$wallet->id}}">{{$wallet->name}}</option>
                                @endforeach
                            </select>
                            @error('wallet_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Limit<span class="required" style="color: red">*</span></label>
                            <input type="number" step="any" min="0" class="form-control" wire:model.live.debounce.300ms="limit"
                                placeholder="wallet Overdraft Limit" required>
                                @error('limit') <span class="error" style="color:red">{{ $message }}</span> @enderror
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

    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="overdraftEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="fa fa-edit"></i> Edit Transaction overdraft</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="update()" >
                    <div class="modal-body">
                          <div class="mb-3">
                            <label class="form-label" for="validationCustom02">Companies<span class="required" style="color: red">*</span></label>
                            <select class="form-control" wire:model.live.debounce.300ms="selectedCompany" required>
                                <option value="">Select </option>
                                @foreach ($companies as $company)
                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            </select>
                            @error('selectedCompany') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom02">Wallets<span class="required" style="color: red">*</span></label>
                            <select class="form-control" wire:model.live.debounce.300ms="wallet_id" required>
                                <option value="">Select Wallet </option>
                                @foreach ($wallets as $wallet)
                                    <option value="{{$wallet->id}}">{{$wallet->name}}</option>
                                @endforeach
                            </select>
                            @error('wallet_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                 <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Limit<span class="required" style="color: red">*</span></label>
                            <input type="number" step="any" min="0" class="form-control" wire:model.live.debounce.300ms="limit"
                                placeholder="wallet Overdraft Limit" required>
                                @error('limit') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Status<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="is_active" required>
                                        <option value="">Select Option</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @error('is_active') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
