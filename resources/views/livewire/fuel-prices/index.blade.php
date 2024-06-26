<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if (Auth::user()->is_admin())
                    <a href="#" data-bs-toggle="modal" data-bs-target="#fuel_priceModal" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New Fuel Price</a>
                    <br>
                    <br>
                    @endif
                    <h4 class="header-title">COMPARE FUEL PRICES</h4>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
          
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
                                                    <th>Fuel Station</th>
                                                    <th>Product Description</th>
                                                    <th>Stock Level</th>
                                                    <th>Currency</th>
                                                    <th>Price</th>
                                                    @if (Auth::user()->is_admin() || Auth::user()->company->type == "Admin")
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    @endif
                                                   
                                                </tr>
                                            </thead>
                    
                    
                                            <tbody>
                                                @if (isset($country->fuel_prices))
                                                    @forelse ($country->fuel_prices as $fuel_price)
                                                        <tr>
                                                            <td>
                                                                <strong>{{$fuel_price->fuel_station ? $fuel_price->fuel_station->name : ""}}</strong> <br>
                                                                <i class="fas fa-envelope"></i> {{$fuel_price->fuel_station ? $fuel_price->fuel_station->email : ""}} | <i class="fas fa-phone"></i> {{$fuel_price->fuel_station ? $fuel_price->fuel_station->phonenumber : ""}} <br>
                                                                <i class="fas fa-map-marker"></i> {{$fuel_price->fuel_station ? $fuel_price->fuel_station->street_address : ""}} {{$fuel_price->fuel_station->suburb ? $fuel_price->fuel_station->suburb.", " : ""}} {{$fuel_price->fuel_station ? $fuel_price->fuel_station->city : ""}} <br>
                                                                <i class="fa fa-clock-o"></i> Office Hours: 
                                                                @if (isset($fuel_price->fuel_station->working_schedule) && $fuel_price->fuel_station->working_schedule->everyday == False)
                                                                    {{$fuel_price->fuel_station->working_schedule ? $fuel_price->fuel_station->working_schedule->first_day : ""}} - {{$fuel_price->fuel_station->working_schedule ? $fuel_price->fuel_station->working_schedule->last_day : ""}} {{$fuel_price->fuel_station->working_schedule ? $fuel_price->fuel_station->working_schedule->start_time : ""}} - {{$fuel_price->fuel_station->working_schedule ? $fuel_price->fuel_station->working_schedule->end_time : ""}}
                                                                @else
                                                                Open Everyday
                                                                @endif
                                                               
                                                            </td>
                                                            
                                                            <td>
                                                                <span class="badge bg-success">
                                                                {{$fuel_price->fuel_type ? $fuel_price->fuel_type->name : ""}}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                @if ($fuel_price->stock_level == "High")
                                                                <span class="badge bg-primary">{{$fuel_price->stock_level}}</span>
                                                                @elseif ($fuel_price->stock_level == "Medium")
                                                                <span class="badge bg-warning">{{$fuel_price->stock_level}}</span>
                                                                @elseif ($fuel_price->stock_level == "Low")
                                                                <span class="badge bg-danger">{{$fuel_price->stock_level}}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <span class="badge bg-primary">
                                                                {{$fuel_price->currency ? $fuel_price->currency->name : ""}}
                                                                </span>
                                                            </td>
                                                            <td>{{$fuel_price->currency ? $fuel_price->currency->symbol : ""}}{{number_format($fuel_price->retail_price,2)}}</td>
                                                            @if (Auth::user()->is_admin() || Auth::user()->company->type == "admin")
                                                            <td><span class="badge bg-{{$fuel_price->status == 1 ? "primary" : "danger"}}">{{$fuel_price->status == 1 ? "Active" : "Inactive"}}</span></td>
                                                            <td class="w-10 line-height-35 table-dropdown">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-bars"></i>
                                                                        <span class="caret"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a href="#" wire:click.prevent="edit({{$fuel_price->id}})" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li>
                                                                        <li>
                                                                            <a href="#" wire:click="delete({{$fuel_price->id}})"
                                                                            wire:confirm="Are you sure you want to delete this fuel price?" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a>
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
                                                                        No Fuel Prices Recorded ....
                                                                    </div>
                                                                   
                                                                </td>
                                                            </tr>
                                                        @endforelse
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


    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="fuel_priceModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Add Fuel Price</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="store()" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Countries<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="selectedCountry" required>
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedCountry') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Fuel Stations<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="fuel_station_id" required>
                                        <option value="">Select Fuel Station</option>
                                        @foreach ($fuel_stations as $fuel_station)
                                            <option value="{{$fuel_station->id}}">{{$fuel_station->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('fuel_station_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Fuel Type<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="fuel_type_id" required>
                                        <option value="">Select Fuel Type</option>
                                        @foreach ($fuel_types as $fuel_type)
                                            <option value="{{$fuel_type->id}}">{{$fuel_type->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('fuel_type_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Currencies<span class="required" style="color: red">*</span></label>
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
                                    <label class="form-label" for="validationCustom01">Pump Price</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="pump_price"
                                        placeholder="Enter pump price" >
                                        @error('pump_price') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Retail Price</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="retail_price"
                                        placeholder="Enter retail price" >
                                        @error('retail_price') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                       

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Stock Levels</label>
                                   <select class="form-control" wire:model.live.debounce.300ms="stock_level">
                                    <option value="">Select Stock level</option>
                                    <option value="High">High</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>
                                   </select>
                                        @error('stock_level') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
                            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-floppy-fill"></i>Save</button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="fuel_priceEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="fas fa-edit"></i> Edit Fuel Price</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="update()" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Countries<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="selectedCountry" required>
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedCountry') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Fuel Stations<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="fuel_station_id" required>
                                        <option value="">Select Fuel Station</option>
                                        @foreach ($fuel_stations as $fuel_station)
                                            <option value="{{$fuel_station->id}}">{{$fuel_station->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('fuel_station_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Fuel Type<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="fuel_type_id" required>
                                        <option value="">Select Fuel Type</option>
                                        @foreach ($fuel_types as $fuel_type)
                                            <option value="{{$fuel_type->id}}">{{$fuel_type->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('fuel_type_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Currencies<span class="required" style="color: red">*</span></label>
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
                                    <label class="form-label" for="validationCustom01">Pump Price</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="pump_price"
                                        placeholder="Enter pump price" >
                                        @error('pump_price') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Retail Price</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="retail_price"
                                        placeholder="Enter retail price" >
                                        @error('retail_price') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                       

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Stock Levels</label>
                                   <select class="form-control" wire:model.live.debounce.300ms="stock_level">
                                    <option value="">Select Stock level</option>
                                    <option value="High">High</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>
                                   </select>
                                        @error('stock_level') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
