<div>
    <x-loading/>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if (!Auth::user()->is_admin())
                    <div class="card-header">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#userModal" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New User</a>
                    
                    </div>
                @endif
               
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
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
                                            <li><a href="#" wire:click.prevent="edit({{$user->id}})" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li>
                                            <li>
                                                <a href="#" wire:click="delete({{$user->id}})"
                                                wire:confirm="Are you sure you want to delete this user?" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a>
                                            </li>
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


    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="userModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog mw-100 w-50">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Create User</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="store()" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Name<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="name"
                                        placeholder="Enter name" required>
                                        @error('name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Surname </label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="surname"
                                        placeholder="Enter surname" >
                                        @error('surname') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Email<span class="required" style="color: red">*</span></label>
                                    <input type="email" class="form-control" wire:model.live.debounce.300ms="email"
                                        placeholder="Enter email" required>
                                        @error('email') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Phonenumber</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="phonenumber"
                                        placeholder="Enter phonenumber" >
                                        @error('phonenumber') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3" >
                                    <label for="name">Select what to use as username?</label>
                                    <br>
                                    <label class="radio-inline mt-2">
                                        <input type="radio" wire:model.debounce.300ms="use_email_as_username" value="Email" name="optradio" >Email
                                      </label>
                                      <label class="radio-inline mt-2">
                                        <input type="radio" wire:model.debounce.300ms="use_email_as_username" value="Phonenumber" name="optradio">Phonenumber
                                      </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Roles<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="role_id" multiple>
                                        <option value="">Select User Role(s)</option>
                                        @foreach ($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                        @error('role_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
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

    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="userEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="fas fa-edit"></i>Edit User</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="update()" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Name<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="name"
                                        placeholder="Enter name" required>
                                        @error('name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Surname </label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="surname"
                                        placeholder="Enter surname" >
                                        @error('surname') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Email<span class="required" style="color: red">*</span></label>
                                    <input type="email" class="form-control" wire:model.live.debounce.300ms="email"
                                        placeholder="Enter email" required>
                                        @error('email') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Phonenumber</label>
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="phonenumber"
                                        placeholder="Enter phonenumber" >
                                        @error('phonenumber') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3" >
                                    <label for="name">Select what to use as username?</label>
                                    <br>
                                    <label class="radio-inline mt-2">
                                        <input type="radio" wire:model.debounce.300ms="use_email_as_username" value="Email" name="optradio" >Email
                                      </label>
                                      <label class="radio-inline mt-2">
                                        <input type="radio" wire:model.debounce.300ms="use_email_as_username" value="Phonenumber" name="optradio">Phonenumber
                                      </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Roles<span class="required" style="color: red">*</span></label>
                                    <select class="form-control" wire:model.live.debounce.300ms="role_id" multiple>
                                        <option value="">Select User Role(s)</option>
                                        @foreach ($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                        @error('role_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Account Status<span class="required" style="color: red">*</span></label>
                            <select class="form-control" wire:model.live.debounce.300ms="status" multiple>
                                <option value="">Select Option</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                                @error('status') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
