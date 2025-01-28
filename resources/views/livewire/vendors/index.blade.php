<div>
    <x-loading/>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if (Auth::user()->is_admin())
                    <a href="#" data-bs-toggle="modal" data-bs-target="#vendorModal" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New Service Provider</a>
                    <br>
                    <br>
                    @endif
                   
                    <h4 class="header-title">Service Providers</h4>
                    <p class="text-muted mb-0">Below is a list of our service providers spanning several african countries. We are constantly adding more service providers throughout Africa.</p>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                   Other
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Office</th>
                                                <th>Currencies</th>
                                                <th>Fuel</th>
                                                <th>Services</th>
                                                @if (Auth::user()->is_admin() || Auth::user()->company->type == "admin")
                                                    <th>Actions</th>
                                                @endif
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         
                                            <tr>
                                                <td colspan="4">
                                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                        No Collection Offices Recorded ....
                                                    </div>
                                                   
                                                </td>
                                            </tr>
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if (isset($countries))
                            @foreach ($countries as $country)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{$country->id}}">
                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{$country->id}}" aria-expanded="false" aria-controls="collapse{{$country->id}}">
                                      {{$country->name}}
                                    </button>
                                </h2>
                                <div id="collapse{{$country->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$country->id}}"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Service Provider</th>
                                                    <th>Services</th>
                                                    <th>Status</th>
                                                    @if (Auth::user()->is_admin() || Auth::user()->company->type == "admin")
                                                    <th>Actions</th>
                                                    @endif
                                                </tr>
                                            </thead>
                    
                    
                                            <tbody>
                                                @if (isset($country->vendors))
                                                    @forelse ($country->vendors as $vendor)
                                                        <tr>
                                                            <td>
                                                                <strong>{{$vendor->name}}</strong> <br>
                                                                <i class="fas fa-map-marker"></i> {{$vendor->street_address}} {{$vendor->suburb ? $vendor->suburb.", " : ""}} {{$vendor->city}} <br>
                                                                <i class="fas fa-envelope"></i> {{$vendor->email}} | <i class="fas fa-phone"></i> {{$vendor->phonenumber}} <br>
                                                                <i class="fa fa-clock-o"></i> Office Hours: {{$vendor->working_schedule ? $vendor->working_schedule->first_day : ""}} - {{$vendor->working_schedule ? $vendor->working_schedule->last_day : ""}} {{$vendor->working_schedule ? $vendor->working_schedule->start_time : ""}} - {{$vendor->working_schedule ? $vendor->working_schedule->end_time : ""}}
                                                            </td>
                                                           
                                                            <td>
                                                                @if ($vendor->services->count()>0)
                                                                    @foreach ($vendor->services as $service)
                                                                    <span class="badge bg-success">{{$service->name}}</span>
                                                                    
                                                                    @endforeach
                                                                @else
                                                                <i class="bi bi-x-lg"></i>
                                                                @endif
                                                            </td>
                                                            <td><span class="badge bg-{{$vendor->status == 1 ? "primary" : "danger"}}">{{$vendor->status == 1 ? "Active" : "Inactive"}}</span></td>
                                                            @if (Auth::user()->is_admin() || Auth::user()->company->type == "admin")
                                                            <td class="w-10 line-height-35 table-dropdown">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-bars"></i>
                                                                        <span class="caret"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a href="#" wire:click.prevent="edit({{$vendor->id}})" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li>
                                                                        <li>
                                                                            <a href="#" wire:click="delete({{$vendor->id}})"
                                                                            wire:confirm="Are you sure you want to delete this vendor?" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="6">
                                                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                                        No Service Providers Found ....
                                                                    </div>
                                                                   
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                        @else
                                                        <tr>
                                                            <td colspan="6">
                                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                                    No Service Providers Found ....
                                                                </div>
                                                               
                                                            </td>
                                                        </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
          
                    
                    </div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div><!-- end col-->
    </div> <!-- end row-->


    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="vendorModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Add Vendor</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="store()" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Countries<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="country_id" required>
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
                                    <label class="form-label" for="validationCustom01">Service Provider Name<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="name"
                                        placeholder="Enter service provider name" required>
                                        @error('name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Phonenumber</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="phonenumber"
                                        placeholder="Enter phonenumber" >
                                        @error('phonenumber') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Email</label>
                                    <input type="email" class="form-control" wire:model.live.debounce.300ms="email"
                                        placeholder="Enter email" >
                                        @error('email') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">City</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="city"
                                        placeholder="Enter city" >
                                        @error('city') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Suburb</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="suburb"
                                        placeholder="Enter suburb" >
                                        @error('suburb') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Street Address</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="street_address"
                                        placeholder="Enter street address" >
                                        @error('street_address') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div style="height: 150px; overflow: auto">
                            <div class="form-group">
                                <table  class="table table-striped table-bordered table-sm table-responsive" cellspacing="0" width="100%"  >
                                    <thead>
                                      <tr>
                                        <th class="th-sm">Services Offered<span class="required" style="color: red">*</span></th>
                                        
                                      </tr>
                                    </thead>
                                    @if ($services->count()>0)
                                    <tbody>
                                        @foreach ($services as $service)
                                      <tr>
                                        <td>
                                            <div class="mb-10">
                                                <input type="checkbox" wire:model.debounce.live.300ms="service_id.{{$service->id}}"  wire:key="{{ $service->id }}"  value="{{$service->id}}"   class="line-style"  />
                                                <label for="one" class="radio-label">{{$service->name}} </label>
                                                @error('service_id.'.$service->id) <span class="text-danger error">{{ $message }}</span>@enderror
                                            </div>
                                        </td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                    @endif
                                  </table>  
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

    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="vendorEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="fas fa-edit"></i> Edit vendor / Collection Office</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="update()" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Countries<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="country_id" required>
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
                                    <label class="form-label" for="validationCustom01">Service Provider Name<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="name"
                                        placeholder="Enter vendor name" required>
                                        @error('name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Phonenumber</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="phonenumber"
                                        placeholder="Enter phonenumber" >
                                        @error('phonenumber') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Email</label>
                                    <input type="email" class="form-control" wire:model.live.debounce.300ms="email"
                                        placeholder="Enter email" >
                                        @error('email') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">City</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="city"
                                        placeholder="Enter city" >
                                        @error('city') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Suburb</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="suburb"
                                        placeholder="Enter suburb" >
                                        @error('suburb') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Street Address</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="street_address"
                                        placeholder="Enter street address" >
                                        @error('street_address') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        
                       <div class="mb-3">
                        <label class="form-label" for="validationCustom01">Services</label>
                        <select class=" form-control" wire:model.debounce.live.300ms="service_id" multiple>
                            <option value="">Select Services</option>
                            @foreach ($services as $service)
                                <option value="{{$service->id}}">{{$service->name}}</option>
                            @endforeach
                        </select>
                        @error('service_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
