<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#tripModal" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New Trip</a>
                  
                </div>
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Horse</th>
                                <th>Trailer(s)</th>
                                <th>Driver</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Customer</th>
                                <th>Cargo</th>
                                <th>Weight/Litreage</th>
                                <th>Currency</th>
                                <th>Rate/Freight</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            @if (isset($trips))

                            @forelse ($trips as $trip)
                            <tr>
                                <td>{{$trip->horse ? $trip->horse->registration_number : ""}} ({{$trip->horse ? $trip->horse->fleet_number : ""}})</td>
                                <td>
                                    @foreach ($trip->trailers as $trailer)
                                    {{$trailer->registration_number}} ({{$trailer->fleet_number}})
                                    @endforeach
                                </td>
                                <td>{{$trip->driver ? $trip->driver->name : ""}} {{$trip->driver ? $trip->driver->surname : ""}}</td>
                                <td>{{$trip->from}}</td>
                                <td>{{$trip->to}}</td>
                                <td>{{$trip->customer ? $trip->customer->name : ""}}</td>
                                <td>{{$trip->cargo}}</td>
                                <td>{{$trip->weight ? $trip->weight." Tons" : ""}} {{$trip->litreage ? " | ".$trip->litreage." Litres" : ""}}</td>
                                <td>{{$trip->currency ? $trip->currency->name : ""}}</td>
                                <td>
                                    @if ($trip->rate)
                                        @ {{$trip->currency ? $trip->currency->symbol : ""}}{{$trip->rate}}
                                    @endif
                                    @if ($trip->rate)
                                        | Freight {{$trip->currency ? $trip->currency->symbol : ""}}{{$trip->freight}}
                                    @endif
                                </td>
                                <td>{{$trip->status}}</td>
                                <td class="w-10 line-height-35 table-dropdown">
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" wire:click.prevent="edit({{$trip->id}})" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li>
                                            <li>
                                                <a href="#" wire:click="delete({{$trip->id}})"
                                                wire:confirm="Are you sure you want to delete this trip?" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                            </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10">
                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                        No Trips Found ....
                                    </div>
                                   
                                </td>
                            </tr>
                            @endforelse

                            @else
                            <tr>
                                <td colspan="10">
                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                        No Trips Found ....
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


    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="tripModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Create Trip</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="store()" >
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Trip Reference</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="trip_ref"
                                        placeholder="Enter reference number">
                                        @error('trip_ref') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                     
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Horses<span class="required" style="color: red">*</span></label>
                                   <select class="form-control" wire:model.live.debounce.300ms="horse_id" required>
                                        <option value="">Select Horse</option>
                                        @foreach ($horses as $horse)
                                            <option value="{{$horse->id}}">{{$horse->registration_number}} ({{$horse->fleet_number}})</option>
                                        @endforeach
                                   </select>
                                        @error('horse_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Trailers<span class="required" style="color: red">*</span></label>
                                   <select class="form-control" wire:model.live.debounce.300ms="trailer_id" multiple required>
                                        <option value="">Multi Select Trailer(s)</option>
                                        @foreach ($trailers as $trailer)
                                            <option value="{{$trailer->id}}">{{$trailer->registration_number}} ({{$trailer->fleet_number}})</option>
                                        @endforeach
                                   </select>
                                        @error('trailer_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Drivers<span class="required" style="color: red">*</span></label>
                                   <select class="form-control" wire:model.live.debounce.300ms="driver_id" required>
                                        <option value="">Select Driver</option>
                                        @foreach ($drivers as $driver)
                                            <option value="{{$driver->id}}">{{$driver->name}} {{$driver->surname}}</option>
                                        @endforeach
                                   </select>
                                        @error('driver_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">From<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="from"
                                        placeholder="Enter from location" required>
                                </select>
                                        @error('cargo') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">To<span class="required" style="color: red">*</span></label>
                                        <input type="text" class="form-control" wire:model.live.debounce.300ms="to"
                                            placeholder="Enter to destination" required>
                                       </select>
                                            @error('to') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                  <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Customer<span class="required" style="color: red">*</span></label>
                           <select class="form-control" wire:model.live.debounce.300ms="customer_id" required>
                                <option value="">Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                           </select>
                                @error('customer_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                    </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Cargo<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="cargo"
                                        placeholder="Enter cargo" required>
                                   </select>
                                        @error('cargo') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
             
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Weight</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="weight"
                                        placeholder="Enter weight" required>
                                </select>
                                        @error('weight') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Litreage</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="litreage"
                                        placeholder="Enter litreage">
                                </select>
                                        @error('litreage') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Start Date<span class="required" style="color: red">*</span></label>
                                    <input type="date" class="form-control" wire:model.live.debounce.300ms="start_date"
                                        placeholder="Enter trip start date" required>
                                </select>
                                        @error('start_date') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Currencies<span class="required" style="color: red">*</span></label>
                                   <select class="form-control" wire:model.live.debounce.300ms="currency_id" required>
                                        <option value="">Select Currency</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{$currency->id}}">{{$currency->name}}</option>
                                        @endforeach
                                   </select>
                                        @error('currency_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                  <div class="row">
                    
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Rate</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="rate"
                                        placeholder="Enter rate" >
                                   </select>
                                        @error('rate') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Freight<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="freight"
                                        placeholder="Enter freight" required>
                                   </select>
                                        @error('freight') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                           
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Description</label>
                                    <textarea class="form-control" wire:model.live.debounce.300ms="description" cols="30" rows="3" placeholder="Enter comments about the trip"></textarea>
                                   </select>
                                        @error('description') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Trip Status</label>
                                   <select class="form-control" wire:model.live.debounce.300ms="status">
                                        <option value="">Select Trip Status</option>
                                        <option value="Scheduled">Scheduled</option>
                                        <option value="Loading Point">Loading Point</option>
                                        <option value="Loaded">Loaded</option>
                                        <option value="Intransit">Intransit</option>
                                        <option value="Offloading Point">Offloading Point</option>
                                        <option value="Offloaded">Offloaded</option>
                                        <option value="On Hold">On Hold</option>
                                   </select>
                                        @error('status') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
 
    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="tripEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="fa fa-edit"></i> Edit Trip</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="update()" >
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Trip Reference</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="trip_ref"
                                        placeholder="Enter reference number">
                                        @error('trip_ref') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                     
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Horses<span class="required" style="color: red">*</span></label>
                                   <select class="form-control" wire:model.live.debounce.300ms="horse_id" required>
                                        <option value="">Select Horse</option>
                                        @foreach ($horses as $horse)
                                            <option value="{{$horse->id}}">{{$horse->registration_number}} ({{$horse->fleet_number}})</option>
                                        @endforeach
                                   </select>
                                        @error('horse_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Trailers<span class="required" style="color: red">*</span></label>
                                   <select class="form-control" wire:model.live.debounce.300ms="trailer_id" multiple required>
                                        <option value="">Multi Select Trailer(s)</option>
                                        @foreach ($trailers as $trailer)
                                            <option value="{{$trailer->id}}">{{$trailer->registration_number}} ({{$trailer->fleet_number}})</option>
                                        @endforeach
                                   </select>
                                        @error('trailer_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Drivers<span class="required" style="color: red">*</span></label>
                                   <select class="form-control" wire:model.live.debounce.300ms="driver_id" required>
                                        <option value="">Select Driver</option>
                                        @foreach ($drivers as $driver)
                                            <option value="{{$driver->id}}">{{$driver->name}} {{$driver->surname}}</option>
                                        @endforeach
                                   </select>
                                        @error('driver_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">From<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="from"
                                        placeholder="Enter from location" required>
                                </select>
                                        @error('cargo') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">To<span class="required" style="color: red">*</span></label>
                                        <input type="text" class="form-control" wire:model.live.debounce.300ms="to"
                                            placeholder="Enter to destination" required>
                                       </select>
                                            @error('to') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                  <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Customer<span class="required" style="color: red">*</span></label>
                           <select class="form-control" wire:model.live.debounce.300ms="customer_id" required>
                                <option value="">Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                           </select>
                                @error('customer_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                    </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Cargo<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="cargo"
                                        placeholder="Enter cargo" required>
                                   </select>
                                        @error('cargo') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
             
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Weight</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="weight"
                                        placeholder="Enter weight" required>
                                </select>
                                        @error('weight') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Litreage</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="litreage"
                                        placeholder="Enter litreage">
                                </select>
                                        @error('litreage') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Start Date<span class="required" style="color: red">*</span></label>
                                    <input type="date" class="form-control" wire:model.live.debounce.300ms="start_date"
                                        placeholder="Enter trip start date" required>
                                </select>
                                        @error('start_date') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Currencies<span class="required" style="color: red">*</span></label>
                                   <select class="form-control" wire:model.live.debounce.300ms="currency_id" required>
                                        <option value="">Select Currency</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{$currency->id}}">{{$currency->name}}</option>
                                        @endforeach
                                   </select>
                                        @error('currency_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                  <div class="row">
                    
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Rate</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="rate"
                                        placeholder="Enter rate" >
                                   </select>
                                        @error('rate') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Freight<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="freight"
                                        placeholder="Enter freight" required>
                                   </select>
                                        @error('freight') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                           
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Description</label>
                                    <textarea class="form-control" wire:model.live.debounce.300ms="description" cols="30" rows="3" placeholder="Enter comments about the trip"></textarea>
                                   </select>
                                        @error('description') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Trip Status</label>
                                   <select class="form-control" wire:model.live.debounce.300ms="status">
                                        <option value="">Select Trip Status</option>
                                        <option value="Scheduled">Scheduled</option>
                                        <option value="Loading Point">Loading Point</option>
                                        <option value="Loaded">Loaded</option>
                                        <option value="Intransit">Intransit</option>
                                        <option value="Offloading Point">Offloading Point</option>
                                        <option value="Offloaded">Offloaded</option>
                                        <option value="On Hold">On Hold</option>
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
