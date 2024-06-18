<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="" data-bs-toggle="modal" data-bs-target="#trailerModal" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New Trailer</a>
                  
                </div>
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Registration#</th>
                                <th>Fleet#</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            @if (isset($trailers))

                            @forelse ($trailers as $trailer)
                            <tr>
                                <td>{{$trailer->registration_number}}</td>
                                <td>{{$trailer->fleet_number}}</td>
                                <td><span class="badge bg-{{$trailer->status == 1 ? "primary" : "danger"}}">{{$trailer->status == 1 ? "Active" : "Inactive"}}</span></td>
                                <td class="w-10 line-height-35 table-dropdown">
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" wire:click.prevent="edit({{$trailer->id}})" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li>
                                            <li>
                                                <a href="#" wire:click="delete({{$trailer->id}})"
                                                wire:confirm="Are you sure you want to delete this trailer?" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                            </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                        No Trailers Found ....
                                    </div>
                                   
                                </td>
                            </tr>
                            @endforelse

                            @else
                            <tr>
                                <td colspan="4">
                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                        No Trailers Found ....
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


    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="trailerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Create Trailer</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="store()" >
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Registration Number<span class="required" style="color: red">*</span></label>
                            <input type="text" class="form-control" wire:model.live.debounce.300ms="registration_number"
                                placeholder="Enter registration number" required>
                                @error('registration_number') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Fleet Number</label>
                            <input type="text" class="form-control" wire:model.live.debounce.300ms="fleet_number"
                                placeholder="Enter trailer fleet number" >
                                @error('fleet_number') <span class="error" style="color:red">{{ $message }}</span> @enderror
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

    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="trailerEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="fas fa-edit"></i> Edit Trailer</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="update()" >
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Registration Number<span class="required" style="color: red">*</span></label>
                            <input type="text" class="form-control" wire:model.live.debounce.300ms="registration_number"
                                placeholder="Enter registration number" required>
                                @error('registration_number') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Fleet Number</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="fleet_number"
                                        placeholder="Enter trailer fleet number" >
                                        @error('fleet_number') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Status</label>
                                    <select class="form-control" wire:model.live.debounce.300ms="status">
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                   </select>
                                        @error('status') <span class="error" style="color:red">{{ $message }}</span> @enderror
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

</div>
