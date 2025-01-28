<div>
    <x-loading/>
    <div class="row">
        <div>
             @include('includes.messages')
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#chargeModal" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New Transaction Charge</a>
                  
                </div>
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Percentage</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            @if (isset($charges))
                                @forelse ($charges as $charge)
                                    <tr>
                                        <td>{{$charge->transaction_type ? $charge->transaction_type->name : ""}}</td>
                                        <td>{{$charge->percentage ? $charge->percentage."%" : ""}}</td>                
                                        <td class="w-10 line-height-35 table-dropdown">
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#" wire:click.prevent="edit({{$charge->id}})" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li>
                                                    <li>
                                                        <a href="#" wire:click="delete({{$charge->id}})"
                                                        wire:confirm="Are you sure you want to delete this transaction charge?" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                    </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Transaction Charges Found ....
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


    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="chargeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Add Transaction Charge</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="store()" >
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom02">Transaction Types<span class="required" style="color: red">*</span></label>
                            <select class="form-control" wire:model.live.debounce.300ms="transaction_type_id" required>
                                <option value="">Select Transaction Type</option>
                                @foreach ($transaction_types as $transaction_type)
                                    <option value="{{$transaction_type->id}}">{{$transaction_type->name}}</option>
                                @endforeach
                            </select>
                            @error('transaction_type_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Percentage<span class="required" style="color: red">*</span></label>
                            <input type="number" step="any" min="0" class="form-control" wire:model.live.debounce.300ms="percentage"
                                placeholder="Transaction Charge Percentage" required>
                                @error('percentage') <span class="error" style="color:red">{{ $message }}</span> @enderror
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

    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="chargeEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="fa fa-edit"></i> Edit Transaction Charge</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="update()" >
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom02">Transaction Types<span class="required" style="color: red">*</span></label>
                            <select class="form-control" wire:model.live.debounce.300ms="transaction_type_id" required>
                                <option value="">Select Transaction Type</option>
                                @foreach ($transaction_types as $transaction_type)
                                    <option value="{{$transaction_type->id}}">{{$transaction_type->name}}</option>
                                @endforeach
                            </select>
                            @error('transaction_type_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Percentage<span class="required" style="color: red">*</span></label>
                            <input type="number" step="any" min="0" class="form-control" wire:model.live.debounce.300ms="percentage"
                                placeholder="Transaction Charge Percentage" required>
                                @error('percentage') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
