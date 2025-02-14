<?php

namespace App\Livewire\Documents;

use Carbon\Carbon;
use App\Models\Folder;
use App\Models\Company;
use Livewire\Component;
use App\Models\Document;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    use WithFileUploads;

    public $category;
    public $company;
    public $company_id;
    public $item_id;
    public $user_id;
    public $documents;
    public $document_id;
    public $folders;
    public $folder_id;
    public $selectedFolder = Null;
    public $is_open = FALSE;
    public $folder_title;

    public $title;
    public $expires_at;
    public $file;
    public $filename;


    private function resetInputFields(){
        $this->title = "";
        $this->folder_title = "";
        $this->file = "";
        $this->expires_at = "";
    }

    public function setFolder($id){
        if ($id == $this->selectedFolder ) {
            if ($this->is_open == FALSE) {
                $this->selectedFolder = $id;
                $this->is_open = TRUE;
            }else{
                $this->selectedFolder = NULL;
                $this->is_open = FALSE;
            }
        }else{
            // dd('is open');
            $this->selectedFolder = $id;
            $this->is_open = TRUE;
        }
        
       
    }


    public function mount($id,$category){
        $this->category = $category;
        $this->item_id = $id;  
    if ($this->category == "company") {
        $this->company = Company::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('company_id', $this->company->id)->latest()->get();
    }
   
   
   
   
    

    }

    public function updatedSelectedFolder($selected_folder_id){

        if(!is_null($selected_folder_id)){
         if ($this->category == "company") {
                $this->company = Company::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('company_id', $this->company->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
        }
    }

    public function deleteDocument($id){
        $document = Document::find($id);
        $document->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Document Deleted Successfully!!",
            position: "center",
        );
    }
    public function deleteFolder($id){
        $folder = Folder::find($id);
        $folder->delete();
        $this->dispatch(
            'alert',
            type : 'success',
            title : "Folder Deleted Successfully!!",
            position: "center",
        );
    }


    public function showFolder(){
        $this->dispatch('show-folderModal');
    }

    public function storeFolder(){
        try{

            $folder = new Folder;
            $folder->user_id = Auth::user()->id;
            $folder->category = $this->category;
            $folder->title = $this->folder_title;
            $folder->save();

            $this->folder_id = $folder->id;

            $this->dispatch('hide-folderModal');
            $this->resetInputFields();
            $this->dispatch(
                'alert',
                type : 'success',
                title : "Folder Created Successfully!!",
                position: "center",
            );
           
        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatch('alert',[
                'type'=>'error',
                'message'=>"Something went wrong while creating folder!!"
            ]);
        }
    }
   
    public function updateFolder(){
        try{

            $folder = Folder::find($this->folder_id);
            $folder->user_id = Auth::user()->id;
            $folder->category = $this->category;
            $folder->title = $this->folder_title;
            $folder->update();

            $this->dispatch('hide-folderEditModal');
            $this->resetInputFields();
            $this->dispatch(
                'alert',
                type : 'success',
                title : "Folder Updated Successfully!!",
                position: "center",
            );
           

        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatch('alert',[
                'type'=>'error',
                'message'=>"Something went wrong while updating folder!!"
            ]);
        }
    }
    public function store(){
        // try{

            if(isset($this->file)){
                $file = $this->file;
                // get file with ext
                $fileNameWithExt = $file->getClientOriginalName();
                //get filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //get extention
                $extention = $file->getClientOriginalExtension();
                //file name to store
                $fileNameToStore= $filename.'_'.time().'.'.$extention;
                $file->storeAs('/documents', $fileNameToStore, 'my_files');
            }
            $document = new Document;

          
            if (isset($this->company)) {
                $document->company_id = $this->company->id;
            }
           
            $document->title = $this->title;

            if (isset($fileNameToStore)) {
                $document->filename = $fileNameToStore;
            }
            if(isset($this->expires_at)){
                $document->expires_at = Carbon::create($this->expires_at)->toDateTimeString();
                $today = now()->toDateTimeString();
                $expire = Carbon::create($this->expires_at)->toDateTimeString();
                if ($today <=  $expire) {
                    $document->status = 1;
                }else{
                    $document->status = 0;
                }
            }else {
                $document->status = 1;
              }
            $document->category = $this->category;
            $document->folder_id = $this->folder_id;
            $document->user_id = Auth::user()->id;
            $document->save();

         

            $this->dispatch('hide-documentModal');
            $this->resetInputFields();
            $this->dispatch(
                'alert',
                type : 'success',
                title : "Document(s) Uploaded Successfully!!",
                position: "center",
            );
           

        // }catch(\Exception $e){
        //     // Set Flash Message
        //     $this->dispatch('alert',[
        //         'type'=>'error',
        //         'message'=>"Something went wrong while uploading document(s)!!"
        //     ]);
        // }
    }

    public function editFolder($id){
        $folder = Folder::find($id);
        $this->category = $folder->category;
        $this->folder_title = $folder->title;
        $this->folder_id = $folder->id;

        $this->dispatch('show-folderEditModal');

        }

    public function edit($id){

        $document = Document::find($id);
        $this->user_id = $document->user_id;
        $this->title = $document->title;
        $this->expires_at = $document->expiry_date;
        $this->filename = $document->filename;
        $this->document_id = $document->id;

        $this->dispatch('show-documentEditModal');

        }

        public function update()
        {
            if ($this->document_id) {
                try{
                    if(isset($this->file)){
                        $file = $this->file;
                        // get file with ext
                        $fileNameWithExt = $file->getClientOriginalName();
                        //get filename
                        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                        //get extention
                        $extention = $file->getClientOriginalExtension();
                        //file name to store
                        $fileNameToStore= $filename.'_'.time().'.'.$extention;
                        $file->storeAs('/documents', $fileNameToStore, 'my_files');

                    }
                $document = Document::find($this->document_id);
                $document->title = $this->title;
                $document->folder_id = $this->folder_id;
                if (isset($fileNameToStore)) {
                    $document->filename = $fileNameToStore;
                }
                if(isset($this->expires_at)){
                    $document->expires_at = Carbon::create($this->expires_at)->toDateTimeString();
                    $today = now()->toDateTimeString();
                    $expire = Carbon::create($this->expires_at)->toDateTimeString();
                    if ($today <=  $expire) {
                        $document->status = 1;
                    }else{
                        $document->status = 0;
                    }
                }
                $document->update();

                $this->dispatch('hide-documentEditModal');
                $this->resetInputFields();
                $this->dispatch(
                    'alert',
                    type : 'success',
                    title : "Document Updated Successfully!!",
                    position: "center",
                );
               
            }catch(\Exception $e){
                // Set Flash Message
                $this->dispatch('alert',[
                    'type'=>'error',
                    'message'=>"Something went wrong while updating document(s)!!"
                ]);
            }

            }
        }


    public function render()
    {
        $this->folders = Folder::where('category', $this->category)->orderBy('title','asc')->get();
        $this->documents = Document::where('category', $this->category)->where('company_id', $this->company->id)->orderBy('title','asc')->get();
        return view('livewire.documents.index',[
            'documents'=> $this->documents,
            'folders'=> $this->folders
        ]);
    }
}
