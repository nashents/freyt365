<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="" data-bs-toggle="modal" data-bs-target="#horseModal" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New Horse</a>
                  
                </div>
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Registration#</th>
                                <th>Make/Model</th>
                                <th>Fleet#</th>
                                <th>Color</th>
                                <th>Default Trailer(s)</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            @if (isset($horses))

                            @forelse ($horses as $horse)
                            <tr>
                                <td>{{$horse->registration_number}}</td>
                                <td>{{$horse->make}} {{$horse->model}}</td>
                                <td>{{$horse->fleet_number}}</td>
                                <td>{{$horse->color}}</td>
                                <td>
                                    @if ($horse->trailers->count()>0)
                                       @foreach ($horse->trailers as $trailer)
                                            {{$trailer->registration_number}} ({{$trailer->fleet_number}}) <br>
                                       @endforeach
                                    @endif
                                </td>
                                <td><span class="badge bg-{{$horse->status == 1 ? "primary" : "danger"}}">{{$horse->status == 1 ? "Active" : "Inactive"}}</span></td>
                                <td class="w-10 line-height-35 table-dropdown">
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" wire:click.prevent="edit({{$horse->id}})" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li>
                                            <li>
                                                <a href="#" wire:click="delete({{$horse->id}})"
                                                wire:confirm="Are you sure you want to delete this horse?" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                            </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">
                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                        No Horses Found ....
                                    </div>
                                   
                                </td>
                            </tr>
                            @endforelse

                            @else
                            <tr>
                                <td colspan="6">
                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                        No Horses Found ....
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


    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="horseModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Create Horse</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="store()" >
                    <div class="modal-body">
                       
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Registration Number<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="registration_number"
                                        placeholder="Enter registration number" required>
                                        @error('registration_number') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Registration Date<span class="required" style="color: red">*</span></label>
                                    <input type="date"  class="form-control" wire:model.live.debounce.300ms="registration_date"
                                        placeholder="Enter registration date" required>
                                        @error('registration_date') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Make<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="make"
                                        placeholder="Enter horse make" required >
                                        @error('make') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Model<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="model"
                                        placeholder="Enter horse model" required>
                                        @error('model') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Fleet Number</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="fleet_number"
                                        placeholder="Enter horse fleet number" >
                                        @error('fleet_number') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Color<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="color" 
                                        placeholder="Enter horse color" required>
                                        @error('color') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="button" class="btn btn-danger btn-rounded btn-sm"   wire:click="remove"  style="float: right; margin-left:2px" > <i class="fa fa-refresh"></i> Refresh Trailers</button>
                                    <button type="button" class="btn btn-primary btn-rounded btn-sm" style="float: right" wire:click="add({{$i}})"> <i class="fa fa-plus"></i> Add another trailer</button>
                                </div>
                            </div>
                        </div>
                        @php
                            $n = 1;
                        @endphp
                        <div class="row">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Trailer {{$n++}}</label>
                                <select class="form-control" wire:model.live.debounce.300ms="trailer_id.0">
                                    <option value="">Select default trailer</option>
                                    @foreach ($trailers as $trailer)
                                        <option value="{{$trailer->id}}">{{$trailer->registration_number}} ({{$trailer->fleet_number}})</option>
                                    @endforeach
                                </select>
                                    @error('trailer_id.0') <span class="error" style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>

                       
                            @foreach ($inputs as $key => $value)
                            <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01">Trailer {{$n++}} </label>
                                                <select class="form-control" wire:model.live.debounce.300ms="trailer_id.{{$value}}">
                                                    <option value="">Select default trailer</option>
                                                    @foreach ($trailers as $trailer)
                                                        <option value="{{$trailer->id}}">{{$trailer->registration_number}} ({{$trailer->fleet_number}})</option>
                                                    @endforeach
                                                </select>
                                                    @error('trailer_id.'.$value) <span class="error" style="color:red">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-1">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01"></label>
                                                <button type="button" class="btn btn-danger btn-rounded xs"   wire:click="remove({{$key}})" style="margin-top:7px;"> <i class="fa fa-times"></i></button>
                                            </div>
                                        </div> --}}
                                    </div>
                            @endforeach
                       
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

    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="horseEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Update Horse</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="update()" >
                    <div class="modal-body">
           
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Registration Number<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="registration_number"
                                        placeholder="Enter registration number" required>
                                        @error('registration_number') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Registration Date<span class="required" style="color: red">*</span></label>
                                    <input type="date"  class="form-control" wire:model.live.debounce.300ms="registration_date"
                                        placeholder="Enter registration date" required>
                                        @error('registration_date') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Make<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="make"
                                        placeholder="Enter horse make" required >
                                        @error('make') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Model<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="model"
                                        placeholder="Enter horse model" required>
                                        @error('model') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Fleet Number</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="fleet_number"
                                        placeholder="Enter horse fleet number" >
                                        @error('fleet_number') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Color<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="color"
                                        placeholder="Enter horse color" required>
                                        @error('color') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Default Trailer(s)</label>
                                    <select class="form-control" wire:model.live.debounce.300ms="trailer_id" multiple>
                                        <option value="">Select default trailer</option>
                                        @foreach ($trailers as $trailer)
                                            <option value="{{$trailer->id}}">{{$trailer->registration_number}} ({{$trailer->fleet_number}})</option>
                                        @endforeach
                                    </select>
                                        @error('trailer_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
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
