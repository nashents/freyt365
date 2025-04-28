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
                                <th>Fleet#</th>
                                <th>Status</th>
                            </tr>
                        </thead>


                        <tbody>
                            @if (isset($trailers))

                            @forelse ($trailers as $trailer)
                            <tr>
                                <td>{{$trailer->registration_number}}</td>
                                <td>{{$trailer->fleet_number}}</td>
                                <td><span class="badge bg-{{$trailer->status == 1 ? "primary" : "danger"}}">{{$trailer->status == 1 ? "Active" : "Inactive"}}</span></td>
                              
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                        No Trailers Found ....
                                    </div>
                                   
                                </td>
                            </tr>
                            @endforelse

                            @else
                            <tr>
                                <td colspan="4">
                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                        No Trailers Found ....
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
