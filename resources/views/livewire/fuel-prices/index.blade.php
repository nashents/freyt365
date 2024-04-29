<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">COMPARE FUEL PRICES</h4>
                    {{-- <p class="text-muted mb-0">Click the accordions below to expand/collapse the accordion content.</p> --}}
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
                                                <th>Fuel Station</th>
                                                <th>Address</th>
                                                <th>Product Description</th>
                                                <th>Stock Level</th>
                                                <th>Currency</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         
                                            <tr>
                                                <td colspan="6">
                                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                        No Fuel Prices Recorded ....
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
                                                    <th>Fuel Station</th>
                                                    <th>Address</th>
                                                    <th>Product Description</th>
                                                    <th>Stock Level</th>
                                                    <th>Currency</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                    
                    
                                            <tbody>
                                                @if (isset($country->fuel_prices))
                                                    @forelse ($country->fuel_prices as $fuel_price)
                                                        <tr>
                                                            <td>{{$fuel_price->fuel_station ? $fuel_price->fuel_station->name : ""}}</td>
                                                            <td>{{$fuel_price->fuel_station ? $fuel_price->fuel_station->street_address : ""}} {{$fuel_price->fuel_station ? $fuel_price->fuel_station->suburb : ""}} {{$fuel_price->fuel_station ? $fuel_price->fuel_station->city : ""}}</td>
                                                            <td>{{$fuel_price->fuel_type ? $fuel_price->fuel_type->name : ""}}</td>
                                                            <td>{{$fuel_price->stock_level}}</td>
                                                            <td>{{$fuel_price->currency ? $fuel_price->currency->name : ""}}</td>
                                                            <td>{{$fuel_price->currency ? $fuel_price->currency->symbol : ""}}{{$fuel_price->price}}</td>
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
</div>
