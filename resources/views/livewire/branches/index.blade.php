<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Our Collection Points</h4>
                    <p class="text-muted mb-0">Below is a list of our branches spanning several african countries. We are constantly adding more branches and collection offices throughout Africa.</p>
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
                                                    <th>Office</th>
                                                    <th>Currencies</th>
                                                    <th>Fuel</th>
                                                    <th>Service</th>
                                                </tr>
                                            </thead>
                    
                    
                                            <tbody>
                                                @if (isset($country->branches))
                                                    @forelse ($country->branches as $branch)
                                                        <tr>
                                                            <td>{{$branch->street_address}} {{$branch->suburb}} {{$branch->city}}</td>
                                                            <td>
                                                                @if ($branch->currencies->count()>0)
                                                                    @foreach ($branch->currencies as $currency)
                                                                    {{$currency->name}}
                                                                    @endforeach
                                                                @else
                                                                <i class="bi bi-x-lg"></i>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($branch->fuel_types->count()>0)
                                                                    @foreach ($branch->fuel_types as $fuel_type)
                                                                    {{$fuel_type->name}}
                                                                    @endforeach
                                                                @else
                                                                <i class="bi bi-x-lg"></i>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($branch->services->count()>0)
                                                                    @foreach ($branch->services as $service)
                                                                    {{$service->name}}
                                                                    @endforeach
                                                                @else
                                                                <i class="bi bi-x-lg"></i>
                                                                @endif
                                                            </td>
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
</div>
