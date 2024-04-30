<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New Company</a>
                  
                </div>
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Company#</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phonenumber</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                                @if (isset($companies))
                                    @forelse ($companies as $company)     
                                    <tr>
                                        <td>{{$company->company_number}}</td>
                                        <td>{{ucfirst($company->type)}}</td>
                                        <td>{{$company->name}}</td>
                                        <td>{{$company->email}}</td>
                                        <td>{{$company->phonenumber}}</td>
                                        <td>{{$company->street_address}} {{$company->suburb}} {{$company->city}} {{$company->country}}</td>
                                        <td><span class="badge bg-{{$company->status == 1 ? "primary" : "danger"}}">{{$company->status == 1 ? "Active" : "Inactive"}}</span></td>
                                        <td class="w-10 line-height-35 table-dropdown">
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href=""><i class="fa fa-edit color-success"></i> Edit</a></li>
                                                    <li><a href="#" ><i class="fa fa-trash color-danger"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7">
                                            <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                No Companies Found ....
                                            </div>
                                           
                                        </td>
                                    </tr>
                                    @endforelse
                                @endif
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->
</div>
