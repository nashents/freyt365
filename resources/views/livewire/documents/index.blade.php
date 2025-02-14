<div>
  
    <x-loading/>
    @if (Auth::user()->is_admin())
        <a href="#" data-bs-toggle="modal" data-bs-target="#documentModal" class="btn btn-outline-primary"><i class="fa fa-plus-square-o"></i> Document</a>
        <a href="#" data-bs-toggle="modal" data-bs-target="#folderModal" class="btn btn-outline-primary"><i class="fa fa-plus-square-o"></i> Folder</a>
        <br>
        <br>
    @endif
   

    <table id="documentsTable" class="table  table-striped table-borderless table-sm " cellspacing="0" width="100%">
        
        <tbody>
            @if ($folders->count()>0)
                @foreach ($folders as $folder)
                    <tr >
                        <td style="padding-top: 15px; width:100px" >   
                            @if ($selectedFolder != $folder->id)   

                                <a href="#" wire:click="setFolder({{$folder->id}})" style="margin-left:20px"><i class="fa fa-folder"></i> {{$folder->title}}</a> 
                                @if (Auth::user()->is_admin())
                                    <a href="#" ><i class="fa fa-edit color-success  fa-xs"></i></a> <a href="#"><i class="fa fa-trash color-danger fa-xs"></i></a> 
                                @endif
                            @else 

                                <a style="margin-left:20px; " href="#" wire:click="setFolder({{$folder->id}})"><i class="fa fa-folder-open"></i> {{$folder->title}}</a>
                                
                                @if ($is_open == True)
                                    @php
                                        $folder_documents = $documents->where('folder_id',$selectedFolder)
                                    @endphp
                                    @if ($folder_documents->count()>0)
                                        @foreach ($folder_documents as $document)
                                            <tr>
                                            <td style="padding-left: 29px;">
                                                <a href="{{asset('myfiles/documents/'.$document->filename)}}" style="margin-left:30px;"><i class="fa fa-file"></i> {{$document->title}} -  {{$document->filename}}</a> | {{$document->expires_at}} <span class="badge bg-{{$document->status == 1 ? "success" : "danger"}}">{{$document->status == 1 ? "Valid" : "Expired"}}</span>
                                                @if (Auth::user()->is_admin())
                                                    <a href="#" ><i class="fa fa-edit fa-xs color-success"></i></a> <a href="#"><i class="fa fa-trash fa-xs color-danger"></i></a>
                                                @endif
                                            </td>
                                            </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td>
                                            <p style="text-alight:center; text-color:grey; margin-left:47px; padding-top:10px;">No documents in this folder.</p> 
                                        </td>
                                    </tr>
                                    @endif
                                @endif
                            @endif 
                        </td> 
                    </tr>
                @endforeach
           
            @endif
            @php
                $uncategorized_documents = $documents->where('folder_id',NULL);
            @endphp
            @if ($uncategorized_documents->count()>0)
       
                @foreach ($uncategorized_documents as $document)
                <tr>
                    <td> 
                        <a href="{{asset('myfiles/documents/'.$document->filename)}}" style="margin-left:20px;"><i class="fa fa-file"></i> {{$document->title}} -  {{$document->filename}}</a> | {{$document->expires_at}} <span class="badge bg-{{$document->status == 1 ? "success" : "danger"}}">{{$document->status == 1 ? "Valid" : "Expired"}}</span>
                        @if (Auth::user()->is_admin())
                             <a href="#"  ><i class="fa fa-edit fa-xs color-success"></i></a> <a href="#" ><i class="fa fa-trash fa-xs color-danger"></i></a>
                        @endif
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>


    
    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="documentModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i>  Add Document(s)</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="store()" >
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title">Folders</label>
                                    <select wire:model.debounce.300ms="folder_id" class="form-control">
                                        <option value="">Select Folder</option>
                                        @foreach ($folders as $folder)
                                        <option value="{{ $folder->id }}">{{ $folder->title }}</option>
                                        @endforeach
                                    </select>
                                    <small>  <a href="#" wire:click="showFolder()" ><i class="fa fa-plus-square-o"></i> New Folder</a></small> 
                                    @error('folder_id') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title">Title<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control"  wire:model.debounce.300ms="title" placeholder="Enter Document Title" required>
                                    @error('title') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="file">Upload File<span class="required" style="color: red">*</span></label>
                                    <input type="file" class="form-control"  wire:model.debounce.300ms="file" placeholder="Upload File" required>
                                    @error('file') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="expiry_date">Expiry Date</label>
                                    <input type="date" class="form-control"  wire:model.debounce.300ms="expires_at" placeholder="Expiry Date" >
                                    @error('expires_at') <span class="error" style="color:red">{{ $message }}</span> @enderror
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

    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="documentEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="fas fa-edit"></i>  Edit Document</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="update()" >
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title">Folders</label>
                                    <select wire:model.debounce.300ms="folder_id" class="form-control">
                                        <option value="">Select Folder</option>
                                        @foreach ($folders as $folder)
                                        <option value="{{ $folder->id }}">{{ $folder->title }}</option>
                                        @endforeach
                                    </select>
                                    <small>  <a href="#" wire:click="showFolder()" ><i class="fa fa-plus-square-o"></i> New Folder</a></small> 
                                    @error('folder_id') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title">Title<span class="required" style="color: red">*</span></label>
                                    <input type="text" class="form-control"  wire:model.debounce.300ms="title" placeholder="Enter Document Title" required>
                                    @error('title') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="file">Upload File<span class="required" style="color: red">*</span></label>
                                    <input type="file" class="form-control"  wire:model.debounce.300ms="file" placeholder="Upload File" required>
                                    @error('file') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="expiry_date">Expiry Date</label>
                                    <input type="date" class="form-control"  wire:model.debounce.300ms="expires_at" placeholder="Expiry Date" >
                                    @error('expires_at') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-gray btn-wide btn-rounded" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i>Close</button>
                            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-floppy-fill"></i>update</button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="folderModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i>  Add Folder</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="storeFolder()" >
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title">Title<span class="required" style="color: red">*</span></label>
                            <input type="text" class="form-control"  wire:model.debounce.300ms="folder_title" placeholder="Enter Folder Title" required>
                            @error('folder_title') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
  
    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="folderModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="fas fa-edit"></i>  Edit Folder</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateFolder()" >
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title">Title<span class="required" style="color: red">*</span></label>
                            <input type="text" class="form-control"  wire:model.debounce.300ms="folder_title" placeholder="Enter Folder Title" required>
                            @error('folder_title') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                       
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-gray btn-wide btn-rounded" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i>Close</button>
                            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-floppy-fill"></i>Update</button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->




    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="documentDeleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-danger">
            <div class="modal-body">
               <center> <strong>Are you sure you want to delete this Document?</strong> </center>
            </div>
            <form >
            <div class="modal-footer no-border">
                <div class="btn-group" role="group">
                    <button type="button" class="btn bg-white btn-wide btn-rounded" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
                    <button wire:click.prevent="deleteDocument()" class="btn bg-black btn-wide btn-rounded" ><i class="fa fa-trash"></i>Delete</button>
                </div>
                <!-- /.btn-group -->
            </div>
        </form>
        </div>
    </div>
</div>
    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="folderDeleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-danger">
            <div class="modal-body">
               <center> <strong>Are you sure you want to delete this Folder?</strong> </center>
            </div>
            <form >
            <div class="modal-footer no-border">
                <div class="btn-group" role="group">
                    <button type="button" class="btn bg-white btn-wide btn-rounded" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
                    <button wire:click.prevent="deleteFolder()" class="btn bg-black btn-wide btn-rounded" ><i class="fa fa-trash"></i>Delete</button>
                </div>
                <!-- /.btn-group -->
            </div>
        </form>
        </div>
    </div>
</div>




</div>

