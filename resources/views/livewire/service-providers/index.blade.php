<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if (Auth::user()->is_admin())
                    <a href="#" data-bs-toggle="modal" data-bs-target="#service_providerModal" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New Service Provider</a>
                    <br>
                    <br>
                    @endif
                   
                    <h4 class="header-title">Service Providers</h4>
                    <p class="text-muted mb-0">Below is a list of our service providers spanning several african countries. We are constantly adding more service providers throughout Africa.</p>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
       
                        @if (isset($service_providers))
                        @forelse ($service_providers as $service_provider)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{$service_provider->id}}">
                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{$service_provider->id}}" aria-expanded="false" aria-controls="collapse{{$service_provider->id}}">
                                      {{$service_provider->name}}
                                      
                                    </button>
                                   
                                </h2>
                                <div id="collapse{{$service_provider->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$service_provider->id}}"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row" style="float: right">
                                            <div class="d-flex flex-wrap gap-2" style="float: right">
                                                <a href="#" wire:click.prevent="edit({{$service_provider->id}})" type="button" class="btn btn-primary rounded-pill">Edit Service Provider</a>
                                                <a href="#" wire:click="delete({{$service_provider->id}})"
                                                    wire:confirm="Are you sure you want to delete this service provider?" type="button" class="btn btn-danger rounded-pill">Delete Service Provider</a>
                                            </div>
                                        </div>
                                       <br>
                                       <br>
                                       <br>
                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="header-title">Services</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        @foreach ($service_provider->services as $service)
                                                            {{$service->name}}
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="header-title">Contact Details</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive-sm">
                                                        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                                            <tbody>
                                                                <tr>
                                                                    <th><i class="fas fa-phone"></i></th>
                                                                    <td>{{$service_provider->phonenumber}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th><i class="fas fa-envelope"></i></th>
                                                                    <td>{{$service_provider->email}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th><i class="fas fa-map-marker"></i></th>
                                                                    <td>{{$service_provider->street_address}} {{$service_provider->suburb ? $service_provider->suburb.", " : ""}} {{$service_provider->city}}</td>
                                                                </tr>     
                                                            </tbody>
                                                        </table>
                                                        </div>
                                                    </div>
                                               
                                                    <br>
                                                    <div class="card-header">
                                                        <h4 class="header-title">Contact Person</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive-sm">
                                                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                                        <tbody>
                                                                    <tr>
                                                                        <th><i class="fas fa-user"></i></th>
                                                                        <td>{{$service_provider->contact_name}} {{$service_provider->contact_surname}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th><i class="fas fa-phone"></i></th>
                                                                        <td>{{$service_provider->contact_phonenumber}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th><i class="fas fa-envelope"></i></th>
                                                                        <td>{{$service_provider->contact_email}}</td>
                                                                    </tr> 
                                                        </tbody>
                                                    </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                @if (Auth::user()->is_admin())
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#officeModal" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New Office</a>
                                                <br>
                                                <br>
                                                @endif
                                                <h4 class="header-title">Offices</h4>
                                            </div>
                                            <div class="card-body">
                                                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>Office</th>
                                                            <th>Office Hours</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (isset($service_provider->offices))
                                                            @forelse ($service_provider->offices as $office)
                                                                <tr>
                                                                    <td>
                                                                        <strong>{{$office->name}}</strong> <br>
                                                                        <i class="fas fa-map-marker"></i> {{$office->street_address}} {{$office->suburb ? $office->suburb.", " : ""}} {{$office->city}} <br>
                                                                        <i class="fas fa-envelope"></i> {{$office->email}} | <i class="fas fa-phone"></i> {{$office->phonenumber}} <br>
                                                                    </td>
                                                                    <td class="w-10 line-height-35 table-dropdown">
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                                                                <i class="fa fa-bars"></i>
                                                                                <span class="caret"></span>
                                                                            </button>
                                                                            <ul class="dropdown-menu">
                                                                                <li><a href="#" wire:click.prevent="editOffice({{$office->id}})" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li>
                                                                                <li>
                                                                                    <a href="#" wire:click="deleteOffice({{$office->id}})"
                                                                                    wire:confirm="Are you sure you want to delete this office ?" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                
                                                                </td>
                                                                </tr>
                                                                @empty
                                                                    <tr>
                                                                        <td colspan="6">
                                                                            <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                                                No Service Provider Offices Found ....
                                                                            </div>
                                                                        
                                                                        </td>
                                                                    </tr>
                                                                @endforelse
                                                                @else
                                                            
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="1">
                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                        No Service Providers Found ....
                                    </div>
                                   
                                </td>
                            </tr>
                            @endforelse
                            @else
                            <tr>
                                <td colspan="1">
                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                        No Service Providers Found ....
                                    </div>
                                   
                                </td>
                            </tr>
                        @endif
          
                    
                    </div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div><!-- end col-->
    </div> <!-- end row-->

    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="officeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Add Office</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="storeOffice()" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Name<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="name"
                                        placeholder="Enter office name" required>
                                        @error('name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Country</label>
                                    <select class="form-control" wire:model.live.debounce.300ms="country_id" >
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                    </select>
                                    @error('country_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Latitude</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="lat"
                                        placeholder="Enter latitude" >
                                        @error('lat') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Longitude</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="long"
                                        placeholder="Enter longitude" >
                                        @error('long') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
    
    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="officeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="fas fa-edit"></i> Edit Office</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateOffice()" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Name<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="name"
                                        placeholder="Enter office name" required>
                                        @error('name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Country</label>
                                    <select class="form-control" wire:model.live.debounce.300ms="country_id" >
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                    </select>
                                    @error('country_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Latitude</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="lat"
                                        placeholder="Enter latitude" >
                                        @error('lat') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Longitude</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="long"
                                        placeholder="Enter longitude" >
                                        @error('long') <span class="error" style="color:red">{{ $message }}</span> @enderror
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


    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="service_providerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Add Service Provider</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="store()" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Name<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="name"
                                        placeholder="Enter service provider name" required>
                                        @error('name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
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
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Contact Name</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="contact_name"
                                        placeholder="Enter contact person name" >
                                        @error('contact_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Contact Surname</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="contact_surname"
                                        placeholder="Enter contact person surname" >
                                        @error('contact_surname') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Contact Email</label>
                                    <input type="email" class="form-control" wire:model.live.debounce.300ms="contact_email"
                                        placeholder="Enter contact person email" >
                                        @error('contact_email') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Contact Phonenumber</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="contact_phonenumber"
                                        placeholder="Enter contact person phonenumber" >
                                        @error('contact_phonenumber') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Latitude</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="lat"
                                        placeholder="Enter latitude" >
                                        @error('lat') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Longitude</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="long"
                                        placeholder="Enter longitude" >
                                        @error('long') <span class="error" style="color:red">{{ $message }}</span> @enderror
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

                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Service Description<span class="required" style="color: red">*</span></label>
                            <textarea class="form-control" wire:model.live.debounce.300ms="description"
                            placeholder=" Describe the service offered"  cols="30" rows="4" required></textarea>
                                @error('description') <span class="error" style="color:red">{{ $message }}</span> @enderror
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

    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="service_providerEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="fas fa-edit"></i> Edit Service Provider</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="update()" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Name<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="name"
                                        placeholder="Enter service_provider name" required>
                                        @error('name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
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
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Contact Name</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="contact_name"
                                        placeholder="Enter contact person name" >
                                        @error('contact_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Contact Surname</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="contact_surname"
                                        placeholder="Enter contact person surname" >
                                        @error('contact_surname') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Contact Email</label>
                                    <input type="email" class="form-control" wire:model.live.debounce.300ms="contact_email"
                                        placeholder="Enter contact person email" >
                                        @error('contact_email') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Contact Phonenumber</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="contact_phonenumber"
                                        placeholder="Enter contact person phonenumber" >
                                        @error('contact_phonenumber') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Latitude</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="lat"
                                        placeholder="Enter latitude" >
                                        @error('lat') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Longitude</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="long"
                                        placeholder="Enter longitude" >
                                        @error('long') <span class="error" style="color:red">{{ $message }}</span> @enderror
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

                       <div class="mb-3">
                        <label class="form-label" for="validationCustom01">Service Description<span class="required" style="color: red">*</span></label>
                        <textarea class="form-control" wire:model.live.debounce.300ms="description"
                        placeholder=" Describe the service offered"  cols="30" rows="4" required></textarea>
                            @error('description') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
