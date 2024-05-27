<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">CREATE A ONCE-OFF ORDER</h4>
                    <p class="text-muted mb-0">If you would like to place an order at only one of our collection offices, select the country and collection office below.</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <p class="mb-1 fw-bold text-muted">Horses(Optional)</p>
                            <p class="text-muted fs-14">
                                Selecting a truck is only optional when you are not placing an order with an insurance company, Whiskey Parking or Peage. If you intend to place an order with an insurance company you have to select a truck and at least one trailer registration number should be specified.
                            </p>

                            <select class="form-control select2" data-toggle="select2" wire:model.live.debounce.300ms="horse_id">
                                <option>Select Horse</option>
                                @foreach ($horses as $horse)
                                    <option value="{{$horse->id}}">{{$horse->registration_number}} ({{$horse->fleet_number}})</option>
                                @endforeach
                            </select>
                            @error('horse_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div> <!-- end col -->

                        <div class="col-lg-6">
                            <p class="mb-1 fw-bold text-muted">Trailers(Optional)</p>
                            <p class="text-muted fs-14">
                                If you intend to place an order with an insurance company you have to enter the at least one trailer registration number
                            </p>

                            <select class="select2 form-control select2-multiple" data-toggle="select2"
                                multiple="multiple" data-placeholder="Choose ...">
                            <option value="">Multi Select Trailer(s)</option>
                            @foreach ($trailers as $trailer)
                                <option value="{{$trailer->id}}">{{$trailer->registration_number}} ({{$trailer->fleet_number}})</option>
                            @endforeach
                            </select>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                            <p class="mb-1 fw-bold text-muted">Drivers<span class="required" style="color: red">*</span></p>
                            <select class="form-control select2" data-toggle="select2" wire:model.live.debounce.300ms="driver_id" required>
                                <option>Select Driver</option>
                                @foreach ($drivers as $driver)
                                    <option value="{{$driver->id}}">{{$driver->name}} {{$driver->surname}}</option>
                                @endforeach
                            </select>
                            @error('driver_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div> <!-- end col -->
                        <div class="col-lg-6">
                            <p class="mb-1 fw-bold text-muted">Countries<span class="required" style="color: red">*</span></p>
                            <select class="form-control select2" data-toggle="select2" wire:model.live.debounce.300ms="selectedCountry" required>
                                <option>Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                            @error('selectedCountry') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div> <!-- end col -->

                       
                    </div> <!-- end row -->
                    <br>
                    @if (!is_null($selectedCountry))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                          
                            <div class="accordion" id="accordionFuelStationsParent">
                        
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFuelStations">
                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseFuelStations" aria-expanded="false" aria-controls="collapseFuelStations">
                                        FUEL STATIONS
                                        </button>
                                    </h2>
                                    <div id="collapseFuelStations" class="accordion-collapse collapse" aria-labelledby="headingFuelStations"
                                        data-bs-parent="#accordionFuelStationsParent">
                                        <div class="accordion-body">
                                            <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Fuel Station</th>
                                                        <th>Address</th>
                                                        <th>Product Description</th>
                                                        <th>Stock Level</th>
                                                        <th>Currency</th>
                                                        <th>Price</th>
                                                        @if (Auth::user()->is_admin() || Auth::user()->company->type == "Admin")
                                                            <th>Actions</th>
                                                        @endif
                                                    
                                                    </tr>
                                                </thead>
                        
                        
                                                <tbody>
                                                    @if (isset($country->fuel_prices))
                                                        @forelse ($country->fuel_prices as $fuel_price)
                                                            <tr>
                                                                <td>{{$fuel_price->fuel_station ? $fuel_price->fuel_station->name : ""}}</td>
                                                                <td>{{$fuel_price->fuel_station ? $fuel_price->fuel_station->street_address : ""}} {{$fuel_price->fuel_station ? $fuel_price->fuel_station->suburb.", " : ""}} {{$fuel_price->fuel_station ? $fuel_price->fuel_station->city : ""}}</td>
                                                                <td>{{$fuel_price->fuel_type ? $fuel_price->fuel_type->name : ""}}</td>
                                                                <td><span class="badge bg-primary">{{$fuel_price->stock_level}}</span></td>
                                                                <td>{{$fuel_price->currency ? $fuel_price->currency->name : ""}}</td>
                                                                <td>{{$fuel_price->currency ? $fuel_price->currency->symbol : ""}}{{number_format($fuel_price->retail_price,2)}}</td>
                                                                <td>Place Order</td>
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
                            </div>
                            <br>
                            @foreach ($services as $service)
                            <div class="accordion" id="accordionServicesParent">
                        
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{$service->id}}">
                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{$service->id}}" aria-expanded="false" aria-controls="collapse{{$service->id}}">
                                        {{strtoupper($service->name)}}
                                        </button>
                                    </h2>
                                    <div id="collapse{{$service->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$service->id}}"
                                        data-bs-parent="#accordionServicesParent">
                                        <div class="accordion-body">

                                            <div class="accordion" id="accordionExample">
                                                @forelse ($service->service_providers as $service_provider)
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
                                                                <div class="card">
                                                                    <div class="card-header">
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
                                                                                            <td>Place Order</td>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            @endforeach
                       
                            
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <br>
                   
                
                    @endif
 

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
</div>
