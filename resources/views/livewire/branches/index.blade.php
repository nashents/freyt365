<div>
    <x-loading/>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if (Auth::user()->is_admin())
                    <a href="#" data-bs-toggle="modal" data-bs-target="#branchModal" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New Branch</a>
                    <br>
                    <br>
                    @endif
                   
                    <h4 class="header-title">Our Collection Points</h4>
                    <p class="text-muted mb-0">Below is a list of our branches spanning several african countries. We are constantly adding more branches and collection offices throughout Africa.</p>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        @if (isset($countries))
                            @foreach ($countries as $country)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{$country->id}}">
                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{$country->id}}" aria-expanded="false" aria-controls="collapse{{$country->id}}">
                                        <img src="{{asset('images/flags/'.$country->flag)}}" width="25px" height="20px" alt=""  > <span style="padding-left: 10px;"><strong>{{strtoupper($country->name)}}</strong></span>
                                    </button>
                                </h2>
                                <div id="collapse{{$country->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$country->id}}"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Office</th>
                                                    <th>Currencies</th>
                                                    <th>Fuel</th>
                                                    <th>Service</th>
                                                    @if (Auth::user()->is_admin() || Auth::user()->company->type == "admin")
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                    @endif
                                                </tr>
                                            </thead>
                    
                    
                                            <tbody>
                                                @if (isset($country->branches))
                                                    @forelse ($country->branches as $branch)
                                                        <tr>
                                                            <td>
                                                                <strong>{{$branch->name}}</strong> <br>
                                                                <i class="fas fa-envelope"></i> {{$branch->email}} | <i class="fas fa-phone"></i> {{$branch->phonenumber}} <br>
                                                                <i class="fas fa-map-marker"></i> {{$branch->street_address}} {{$branch->suburb ? $branch->suburb.", " : ""}} {{$branch->city}} <br>
                                                                <i class="fa fa-clock-o"></i> Office Hours: 
                                                                @if ($branch->working_schedule)
                                                                    @if ($branch->working_schedule->everyday == False)
                                                                        {{$branch->working_schedule ? $branch->working_schedule->first_day : ""}} - {{$branch->working_schedule ? $branch->working_schedule->last_day : ""}} {{$branch->working_schedule ? $branch->working_schedule->start_time : ""}} - {{$branch->working_schedule ? $branch->working_schedule->end_time : ""}}
                                                                    @else   
                                                                        Open 24/7
                                                                    @endif
                                                                @else
                                                                        Open 24/7
                                                                @endif
                                                                
                                                               
                                                            </td>
                                                            <td>
                                                                @if ($branch->currencies->count()>0)
                                                                    @foreach ($branch->currencies as $currency)
                                                                     <span class="badge bg-primary">{{$currency->name}}</span>
                                                                    @endforeach
                                                                @else
                                                                <span class="badge bg-secondary">N/A</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($branch->fuel_types->count()>0)
                                                                    @foreach ($branch->fuel_types as $fuel_type)
                                                                    <span class="badge bg-success">{{$fuel_type->name}}</span>
                                                                    
                                                                    @endforeach
                                                                @else
                                                                <span class="badge bg-secondary">N/A</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($branch->services->count()>0)
                                                                    @foreach ($branch->services as $service)
                                                                    <span class="badge bg-warning">{{$service->name}}</span>
                                                                    @endforeach
                                                                @else
                                                                <span class="badge bg-secondary">N/A</span>
                                                                @endif
                                                            </td>
                                                            @if (Auth::user()->is_admin() || Auth::user()->company->type == "admin")
                                                            <td><span class="badge bg-{{$branch->status == 1 ? "primary" : "danger"}}">{{$branch->status == 1 ? "Active" : "Inactive"}}</span></td>
                                                            <td class="w-10 line-height-35 table-dropdown">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-bars"></i>
                                                                        <span class="caret"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a href="#" wire:click.prevent="edit({{$branch->id}})" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li>
                                                                        <li>
                                                                            <a href="#" wire:click="delete({{$branch->id}})"
                                                                            wire:confirm="Are you sure you want to delete this branch?" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                            @endif
                                                        </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="6">
                                                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                                        No Collection Offices Recorded ....
                                                                    </div>
                                                                   
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                        @else
                                                        <tr>
                                                            <td colspan="6">
                                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                                    No Collection Offices Recorded ....
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


    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="branchModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog mw-100 w-50">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Add Branch / Collection Office</h4>
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
                                    <label class="form-label" for="validationCustom01">Branch Name<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="name"
                                        placeholder="Enter branch name" required>
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
                            <label class="form-label" for="validationCustom01">Location Pin</label>
                            <input type="text" class="form-control" wire:model.live.debounce.300ms="location"
                                placeholder="Copy & Paste Location Pin" >
                                @error('location') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>

                        <h5 class="underline mt-30">Office Hours</h5> 
                        <br>
                        <div class="row">
                            <div class="mb-10">
                                <input type="checkbox" wire:model.live.debounce.300ms="everyday" class="line-style" />
                                <label for="one" class="radio-label">Everyday ?</label>
                                @error('everyday') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                           
                        </div>
                        <br>
                        @if ($everyday == False)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">First Day</label>
                                    <select  class="form-control" wire:model.live.debounce.300ms="first_day">
                                        <option value="">Select First Day</option>
                                        <option value="Mon">Mon</option>
                                        <option value="Tue">Tue</option>
                                        <option value="Wed">Wed</option>
                                        <option value="Thur">Thur</option>
                                        <option value="Fri">Fri</option>
                                        <option value="Sat">Sat</option>
                                        <option value="Sun">Sun</option>
                                    </select>
                                        @error('first_day') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Last Day</label>
                                    <select  class="form-control" wire:model.live.debounce.300ms="last_day">
                                        <option value="">Select Last Day</option>
                                        <option value="Mon">Mon</option>
                                        <option value="Tue">Tue</option>
                                        <option value="Wed">Wed</option>
                                        <option value="Thur">Thur</option>
                                        <option value="Fri">Fri</option>
                                        <option value="Sat">Sat</option>
                                        <option value="Sun">Sun</option>
                                    </select>
                                        @error('last_day') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Starting Time</label>
                                    <select  class="form-control" wire:model.live.debounce.300ms="start_time">
                                        <option value="">Select Starting Time</option>
                                        <option value="0100">0100</option>
                                        <option value="0200">0200</option>
                                        <option value="0300">0300</option>
                                        <option value="0400">0400</option>
                                        <option value="0500">0500</option>
                                        <option value="0600">0600</option>
                                        <option value="0700">0700</option>
                                        <option value="0800">0800</option>
                                        <option value="0900">0900</option>
                                        <option value="1000">1000</option>
                                        <option value="1100">1100</option>
                                        <option value="1200">1200</option>
                                        <option value="1300">1300</option>
                                        <option value="1400">1400</option>
                                        <option value="1500">1500</option>
                                        <option value="1600">1600</option>
                                        <option value="1700">1700</option>
                                        <option value="1800">1800</option>
                                        <option value="1900">1900</option>
                                        <option value="2000">2000</option>
                                        <option value="2100">2100</option>
                                        <option value="2200">2200</option>
                                        <option value="2300">2300</option>
                                        <option value="2400">2400</option>
                                    </select>
                                        @error('start_time') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Finishing Time</label>
                                    <select  class="form-control" wire:model.live.debounce.300ms="end_time">
                                        <option value="">Select Finishing Time</option>
                                        <option value="0100">0100</option>
                                        <option value="0200">0200</option>
                                        <option value="0300">0300</option>
                                        <option value="0400">0400</option>
                                        <option value="0500">0500</option>
                                        <option value="0600">0600</option>
                                        <option value="0700">0700</option>
                                        <option value="0800">0800</option>
                                        <option value="0900">0900</option>
                                        <option value="1000">1000</option>
                                        <option value="1100">1100</option>
                                        <option value="1200">1200</option>
                                        <option value="1300">1300</option>
                                        <option value="1400">1400</option>
                                        <option value="1500">1500</option>
                                        <option value="1600">1600</option>
                                        <option value="1700">1700</option>
                                        <option value="1800">1800</option>
                                        <option value="1900">1900</option>
                                        <option value="2000">2000</option>
                                        <option value="2100">2100</option>
                                        <option value="2200">2200</option>
                                        <option value="2300">2300</option>
                                        <option value="2400">2400</option>
                                    </select>
                                        @error('end_time') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        @endif
                        
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
                        <br>
                        <div style="height: 150px; overflow: auto">
                            <div class="form-group">
                                <table  class="table table-striped table-bordered table-sm table-responsive" cellspacing="0" width="100%" >
                                    <thead>
                                      <tr>
                                        <th class="th-sm">Currencies Available<span class="required" style="color: red">*</span></th>
                                      </tr>
                                    </thead>
                                    @if ($currencies->count()>0)
                                    <tbody>
                                        @foreach ($currencies as $currency)
                                      <tr>
                                        <td>
                                            <div class="mb-10">
                                                <input type="checkbox" wire:model.live.debounce.300ms="currency_id.{{$currency->id}}"  wire:key="{{ $currency->id }}" value="{{$currency->id}}"  class="line-style"  />
                                                <label for="one" class="radio-label">{{$currency->name}} </label>
                                                @error('currency_id.'.$currency->id) <span class="text-danger error">{{ $message }}</span>@enderror
                                            </div>
                                        </td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                    @endif
                                  </table>  
                            </div>
                   
                        </div>
                        <br>
                        <div style="height: 150px; overflow: auto">
                            <div class="form-group">
                                <table  class="table table-striped table-bordered table-sm table-responsive" cellspacing="0" width="100%" >
                                    <thead>
                                      <tr>
                                        <th class="th-sm">Fuel Types Available<span class="required" style="color: red">*</span></th>
                                      </tr>
                                    </thead>
                                    @if ($fuel_types->count()>0)
                                    <tbody>
                                        @foreach ($fuel_types as $fuel_type)
                                      <tr>
                                        <td>
                                            <div class="mb-10">
                                                <input type="checkbox" wire:model.live.debounce.300ms="fuel_type_id.{{$fuel_type->id}}"  wire:key="{{ $fuel_type }}" value="{{$fuel_type->id}}"  class="line-style"  />
                                                <label for="one" class="radio-label">{{$fuel_type->name}} </label>
                                                @error('fuel_type_id.'.$fuel_type->id) <span class="text-danger error">{{ $message }}</span>@enderror
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

    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="branchEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog mw-100 w-50">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="fas fa-edit"></i> Edit Branch / Collection Office</h4>
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
                                    <label class="form-label" for="validationCustom01">Branch Name<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="name"
                                        placeholder="Enter branch name" required>
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

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Location Pin</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="location"
                                        placeholder="Copy & Paste Location Pin" >
                                        @error('location') <span class="error" style="color:red">{{ $message }}</span> @enderror
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

                        <h5 class="underline mt-30">Office Hours</h5> 
                        <br>
                        <div class="row">
                            <div class="mb-10">
                                <input type="checkbox" wire:model.live.debounce.300ms="everyday" class="line-style" />
                                <label for="one" class="radio-label">Everyday ?</label>
                                @error('everyday') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                           
                        </div>
                        <br>
                        @if ($everyday == False)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">First Day</label>
                                    <select  class="form-control" wire:model.live.debounce.300ms="first_day">
                                        <option value="">Select First Day</option>
                                        <option value="Mon">Mon</option>
                                        <option value="Tue">Tue</option>
                                        <option value="Wed">Wed</option>
                                        <option value="Thur">Thur</option>
                                        <option value="Fri">Fri</option>
                                        <option value="Sat">Sat</option>
                                        <option value="Sun">Sun</option>
                                    </select>
                                        @error('first_day') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Last Day</label>
                                    <select  class="form-control" wire:model.live.debounce.300ms="last_day">
                                        <option value="">Select Last Day</option>
                                        <option value="Mon">Mon</option>
                                        <option value="Tue">Tue</option>
                                        <option value="Wed">Wed</option>
                                        <option value="Thur">Thur</option>
                                        <option value="Fri">Fri</option>
                                        <option value="Sat">Sat</option>
                                        <option value="Sun">Sun</option>
                                    </select>
                                        @error('last_day') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Starting Time</label>
                                    <select  class="form-control" wire:model.live.debounce.300ms="start_time">
                                        <option value="">Select Starting Time</option>
                                        <option value="0100">0100</option>
                                        <option value="0200">0200</option>
                                        <option value="0300">0300</option>
                                        <option value="0400">0400</option>
                                        <option value="0500">0500</option>
                                        <option value="0600">0600</option>
                                        <option value="0700">0700</option>
                                        <option value="0800">0800</option>
                                        <option value="0900">0900</option>
                                        <option value="1000">1000</option>
                                        <option value="1100">1100</option>
                                        <option value="1200">1200</option>
                                        <option value="1300">1300</option>
                                        <option value="1400">1400</option>
                                        <option value="1500">1500</option>
                                        <option value="1600">1600</option>
                                        <option value="1700">1700</option>
                                        <option value="1800">1800</option>
                                        <option value="1900">1900</option>
                                        <option value="2000">2000</option>
                                        <option value="2100">2100</option>
                                        <option value="2200">2200</option>
                                        <option value="2300">2300</option>
                                        <option value="2400">2400</option>
                                    </select>
                                        @error('start_time') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Finishing Time</label>
                                    <select  class="form-control" wire:model.live.debounce.300ms="end_time">
                                        <option value="">Select Finishing Time</option>
                                        <option value="0100">0100</option>
                                        <option value="0200">0200</option>
                                        <option value="0300">0300</option>
                                        <option value="0400">0400</option>
                                        <option value="0500">0500</option>
                                        <option value="0600">0600</option>
                                        <option value="0700">0700</option>
                                        <option value="0800">0800</option>
                                        <option value="0900">0900</option>
                                        <option value="1000">1000</option>
                                        <option value="1100">1100</option>
                                        <option value="1200">1200</option>
                                        <option value="1300">1300</option>
                                        <option value="1400">1400</option>
                                        <option value="1500">1500</option>
                                        <option value="1600">1600</option>
                                        <option value="1700">1700</option>
                                        <option value="1800">1800</option>
                                        <option value="1900">1900</option>
                                        <option value="2000">2000</option>
                                        <option value="2100">2100</option>
                                        <option value="2200">2200</option>
                                        <option value="2300">2300</option>
                                        <option value="2400">2400</option>
                                    </select>
                                        @error('end_time') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        @endif
                        
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

                       <div class="mb-3">
                        <label class="form-label" for="validationCustom01">Currencies</label>
                        <select class=" form-control" wire:model.debounce.live.300ms="currency_id" multiple>
                            <option value="">Select Currencies</option>
                            @foreach ($currencies as $currency)
                                <option value="{{$currency->id}}">{{$currency->name}}</option>
                            @endforeach
                        </select>
                        @error('currency_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                       </div>

                       <div class="mb-3">
                        <label class="form-label" for="validationCustom01">Fuel Types</label>
                        <select class=" form-control" wire:model.debounce.live.300ms="fuel_type_id" multiple>
                            <option value="">Select Fuel Type(s)</option>
                            @foreach ($fuel_types as $fuel_type)
                                <option value="{{$fuel_type->id}}">{{$fuel_type->name}}</option>
                            @endforeach
                        </select>
                        @error('fuel_type_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
