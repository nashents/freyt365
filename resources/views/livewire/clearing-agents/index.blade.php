<div>
    <x-loading/>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#clearing_agentModal" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New Clearing Agent</a>
                  
                </div>
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phonenumber</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            @if (isset($clearing_agents))
                                @forelse ($clearing_agents as $clearing_agent)     
                                <tr>
                                    <td>{{$clearing_agent->name}} {{$clearing_agent->surname}}</td>
                                    <td>{{$clearing_agent->email}}</td>
                                    <td>{{$clearing_agent->phonenumber}}</td>
                                    <td>{{$clearing_agent->street_address}} {{$clearing_agent->suburb}} {{$clearing_agent->city}} {{$clearing_agent->country}}</td>
                                    <td><span class="badge bg-{{$clearing_agent->status == 1 ? "primary" : "danger"}}">{{$clearing_agent->status == 1 ? "Active" : "Inactive"}}</span></td>
                                    <td class="w-10 line-height-35 table-dropdown">
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-bars"></i>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#" wire:click.prevent="edit({{$clearing_agent->id}})" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li>
                                                <li>
                                                    <a href="#" wire:click="delete({{$clearing_agent->id}})"
                                                    wire:confirm="Are you sure you want to delete this clearing agent?" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a>
                                                </li>
                                          
                                            </ul>
                                        </div>
                                </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">
                                        <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                            No Clearing Agents Found ....
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


    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="clearing_agentModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Create Clearing Agent</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="store()" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Name<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="name"
                                        placeholder="Enter name" required>
                                        @error('name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Surname</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="surname"
                                        placeholder="Enter surname">
                                        @error('surname') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Email</label>
                                    <input type="email" class="form-control" wire:model.live.debounce.300ms="email"
                                        placeholder="Enter email" >
                                        @error('email') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Phonenumber</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="phonenumber"
                                        placeholder="Enter phonenumber" >
                                        @error('phonenumber') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Country</label>
                                   <select  class="form-control" wire:model.live.debounce.300ms="country_id">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                   </select>
                                        @error('country_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">City</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="city"
                                        placeholder="Enter city" >
                                        @error('city') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Suburb</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="suburb"
                                    placeholder="Enter suburb" >
                                        @error('suburb') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Street Address</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="street_address"
                                        placeholder="Enter street address" >
                                        @error('street_address') <span class="error" style="color:red">{{ $message }}</span> @enderror
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

    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="clearing_agentEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="fas fa-edit"></i> Edit Clearing Agent</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="update()" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Name<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="name"
                                        placeholder="Enter name" required>
                                        @error('name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Surname</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="surname"
                                        placeholder="Enter surname" >
                                        @error('surname') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Email</label>
                                    <input type="email" class="form-control" wire:model.live.debounce.300ms="email"
                                        placeholder="Enter email" >
                                        @error('email') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Phonenumber</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="phonenumber"
                                        placeholder="Enter phonenumber" >
                                        @error('phonenumber') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Country</label>
                                   <select  class="form-control" wire:model.live.debounce.300ms="country_id">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                   </select>
                                        @error('country_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">City</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="city"
                                        placeholder="Enter city" >
                                        @error('city') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Suburb</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="suburb"
                                    placeholder="Enter suburb" >
                                        @error('suburb') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Street Address</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="street_address"
                                        placeholder="Enter street address" >
                                        @error('street_address') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
