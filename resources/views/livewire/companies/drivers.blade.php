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
                                <th>ID</th>
                                <th>Fullname</th>
                                <th>ID#</th>
                                <th>Passport#</th>
                                <th>License#</th>
                                <th>Phonenumber</th>
                                <th>Status</th>
                              
                            </tr>
                        </thead>


                        <tbody>
                            @if (isset($drivers))

                            @forelse ($drivers as $driver)
                            <tr>
                                <td>{{$driver->id}}</td>
                                <td>{{$driver->name}} {{$driver->surname}}</td>
                                <td>{{$driver->idnumber}}</td>
                                <td>{{$driver->passport_number}}</td>
                                <td>{{$driver->license_number}}</td>
                                <td>{{$driver->phonenumber}}</td>
                                <td><span class="badge bg-{{$driver->status == 1 ? "primary" : "danger"}}">{{$driver->status == 1 ? "Active" : "Inactive"}}</span></td>
                               
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">
                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                        No Drivers Found ....
                                    </div>
                                   
                                </td>
                            </tr>
                            @endforelse

                            @else
                            <tr>
                                <td colspan="7">
                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                        No Drivers Found ....
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
