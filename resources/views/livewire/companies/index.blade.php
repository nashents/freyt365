<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                    <a href="" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New Company</a>
                  
                </div> --}}
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
                                        <td>{{$company->street_address}} {{$company->suburb}}{{$company->city ? ", ".$company->city : ""}} {{$company->country}}</td>
                                        <td><span class="badge bg-{{($company->authorization == 'approved') ? 'primary' : (($company->authorization == 'rejected') ? 'danger' : 'warning') }}">{{($company->authorization == 'approved') ? 'approved' : (($company->authorization == 'rejected') ? 'rejected' : 'pending') }}</span></td>
                                        <td class="w-10 line-height-35 table-dropdown">
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#" wire:click.prevent="showAuthorize({{$company->id}})" class="dropdown-item"><i class="fa fa-gavel color-success"></i> Authorize</a></li>
                                                    {{-- <li><a href="#" wire:click.prevent="edit({{$company->id}})" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li> --}}
                                                    <li>
                                                        <a href="#" wire:click="delete({{$company->id}})"
                                                        wire:confirm="Are you sure you want to delete this company?" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a>
                                                    </li>
                                              
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


    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="authorizationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="fas fa-gavel"></i> Authorize Company</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="saveAuthorization()" >
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Authorize<span class="required" style="color: red">*</span></label>
                           <select  class="form-control" wire:model.live.debounce.300ms="authorization" required>
                                <option value="">Select Option</option>
                                <option value="approved">Approve</option>
                                <option value="rejected">Reject</option>
                           </select>
                           @error('authorization') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Reason</label>
                          <textarea class="form-control" wire:model.live.debounce.300ms="reason" cols="30" rows="4"></textarea>
                           @error('reason') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
</div>
