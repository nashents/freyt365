<div>
    <x-loading/>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
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


    

</div>
