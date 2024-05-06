<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New User</a>
                  
                </div>
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fullname</th>
                                <th>Username</th>
                                <th>Phonenumber</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            @if (isset($users))

                            @forelse ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}} {{$user->surname}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->phonenumber}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if ($user->roles->count()>0)
                                        @foreach ($user->roles as $role)
                                            {{$role->name}}
                                        @endforeach
                                    @endif
                                </td>
                                <td><span class="badge bg-{{$user->status == 1 ? "primary" : "danger"}}">{{$user->status == 1 ? "Active" : "Inactive"}}</span></td>
                                <td class="w-10 line-height-35 table-dropdown">
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li>
                                            <li><a href="#" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a></li>
                                        </ul>
                                    </div>
                            </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">
                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                        No Users Found ....
                                    </div>
                                   
                                </td>
                            </tr>
                            @endforelse

                            @else
                            <tr>
                                <td colspan="8">
                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                        No Users Found ....
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
