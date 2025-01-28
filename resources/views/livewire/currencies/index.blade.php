<div>
    <div class="row">
        <div>
             @include('includes.messages')
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#currencyModal" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New Currency</a>
                  
                </div>
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Code</th>
                                <th>Symbol</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            @if (isset($currencies))
                                @forelse ($currencies as $currency)
                                    <tr>
                                        <td>{{$currency->fullname}}</td>
                                        <td>{{$currency->name}}</td>                
                                        <td>{{$currency->symbol}}</td>                
                                        <td class="w-10 line-height-35 table-dropdown">
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @if ($currency->user_id != Null)
                                                        <li><a href="#" wire:click.prevent="edit({{$currency->id}})" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li>
                                                        <li>
                                                            <a href="#" wire:click="delete({{$currency->id}})"
                                                            wire:confirm="Are you sure you want to delete this currency?" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                    </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Currencies Found ....
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


    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="currencyModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Add Currency</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="store()" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Fulllname<span class="required" style="color: red">*</span></label>
                                    <input type="text"  class="form-control" wire:model.live.debounce.300ms="fullname"
                                        placeholder="eg United States Dollar" required>
                                        @error('fullname') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Code<span class="required" style="color: red">*</span></label>
                                    <input type="text"  class="form-control" wire:model.live.debounce.300ms="name"
                                        placeholder="eg USD" required>
                                        @error('name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Symbol<span class="required" style="color: red">*</span></label>
                                    <input type="text"  class="form-control" wire:model.live.debounce.300ms="symbol"
                                        placeholder="eg $" required>
                                        @error('symbol') <span class="error" style="color:red">{{ $message }}</span> @enderror
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

    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="currencyEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="fa fa-edit"></i> Edit Transaction currency</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="update()" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Fulllname<span class="required" style="color: red">*</span></label>
                                    <input type="text"  class="form-control" wire:model.live.debounce.300ms="fullname"
                                        placeholder="eg United States Dollar" required>
                                        @error('fullname') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Code<span class="required" style="color: red">*</span></label>
                                    <input type="text"  class="form-control" wire:model.live.debounce.300ms="name"
                                        placeholder="eg USD" required>
                                        @error('name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Symbol<span class="required" style="color: red">*</span></label>
                                    <input type="text"  class="form-control" wire:model.live.debounce.300ms="symbol"
                                        placeholder="eg $" required>
                                        @error('symbol') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
