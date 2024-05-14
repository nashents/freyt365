<?php

namespace App\Livewire\Documents;

use Livewire\Component;
use App\Models\Document;

class Index extends Component
{

    use WithFileUploads;

    public $category;
    public $loading_point;
    public $loading_point_id;
    public $offloading_point;
    public $offloading_point_id;
    public $truck_stop;
    public $truck_stop_id;
    public $horse;
    public $horse_id;
    public $consignee;
    public $consignee_id;
    public $incident;
    public $incident_id;
    public $route;
    public $route_id;
    public $vehicle;
    public $vehicle_id;
    public $trailer;
    public $trailer_id;
    public $requisition;
    public $requisition_id;
    public $employee;
    public $employee_id;
    public $cash_flow;
    public $cash_flow_id;
    public $company;
    public $company_id;
    public $vendor;
    public $vendor_id;
    public $recovery;
    public $recovery_id;
    public $payment;
    public $payment_id;
    public $broker;
    public $broker_id;
    public $department;
    public $department_id;
    public $clearing_agent;
    public $clearing_agent_id;
    public $purchase;
    public $purchase_id;
    public $agent;
    public $agent_id;
    public $item_id;
    public $asset;
    public $asset_id;
    public $transporter;
    public $transporter_id;
    public $customer;
    public $customer_id;
    public $user_id;
    public $documents;
    public $document_id;
    public $folders;
    public $folder_id;
    public $selectedFolder;
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
            $this->selectedFolder = $id;
            $this->is_open = TRUE;
        }  
    }


    public function mount($id,$category){
        $this->category = $category;
        $this->item_id = $id;
    if ($this->category == "customer") {
        $this->customer = Customer::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('customer_id', $this->customer->id)->latest()->get();
    }
    elseif ($this->category == "employee") {
        $this->employee = Employee::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('employee_id', $this->employee->id)->latest()->get();
    }
    elseif ($this->category == "consignee") {
        $this->consignee = Consignee::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('consignee_id', $this->consignee->id)->latest()->get();
    }
    elseif ($this->category == "department") {
        $this->department = Department::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('department_id', $this->department->id)->latest()->get();
    }
    elseif ($this->category == "incident") {
        $this->incident = Incident::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('incident_id', $this->incident->id)->latest()->get();
    }
    elseif ($this->category == "truck_stop") {
        $this->truck_stop = TruckStop::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('truck_stop_id', $this->truck_stop->id)->latest()->get();
    }
    elseif ($this->category == "loading_point") {
        $this->loading_point = LoadingPoint::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('loading_point_id', $this->loading_point->id)->latest()->get();
    }
    elseif ($this->category == "offloading_point") {
        $this->offloading_point = OffloadingPoint::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('offloading_point_id', $this->offloading_point->id)->latest()->get();
    }
    elseif ($this->category == "route") {
        $this->route = Route::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('route_id', $this->route->id)->latest()->get();
    }
    elseif ($this->category == "horse") {
        $this->horse = Horse::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('horse_id', $this->horse->id)->latest()->get();
    }
    elseif ($this->category == "trailer") {
        $this->trailer = Trailer::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('trailer_id', $this->trailer->id)->latest()->get();
    }
    elseif ($this->category == "requisition") {
        $this->requisition = Requisition::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('requisition_id', $this->requisition->id)->latest()->get();
    }
    elseif ($this->category == "vehicle") {
        $this->vehicle = Vehicle::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('vehicle_id', $this->vehicle->id)->latest()->get();
    }
    elseif ($this->category == "company") {
        $this->company = Company::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('company_id', $this->company->id)->latest()->get();
    }
    elseif ($this->category == "cash_flow") {
        $this->cash_flow = CashFlow::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('cash_flow_id', $this->cash_flow->id)->latest()->get();
    }
    elseif ($this->category == "recovery") {
        $this->recovery = Recovery::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('recovery_id', $this->recovery->id)->latest()->get();
    }
    elseif ($this->category == "payment") {
        $this->payment = Payment::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('payment_id', $this->payment->id)->latest()->get();
    }
    elseif ($this->category == "asset") {
        $this->asset = Asset::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('asset_id', $this->asset->id)->latest()->get();
    }
    elseif ($this->category == "clearing_agent") {
        $this->clearing_agent = ClearingAgent::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('clearing_agent_id', $this->clearing_agent->id)->latest()->get();
    }
    elseif ($this->category == "purchase") {
        $this->purchase = Purchase::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('purchase_id', $this->purchase->id)->latest()->get();
    }
    elseif ($this->category == "vendor") {
        $this->vendor = Vendor::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('vendor_id', $this->vendor->id)->latest()->get();
    }
    elseif ($this->category == "broker") {
        $this->broker = Broker::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('broker_id', $this->broker->id)->latest()->get();
    }
    elseif ($this->category == "transporter") {
        $this->transporter = Transporter::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('transporter_id', $this->transporter->id)->latest()->get();
    }
    elseif ($this->category == "agent") {
        $this->agent = Agent::find($id);
        $this->folders = Folder::where('category', $this->category)->latest()->get();
        $this->documents = Document::where('category', $this->category)
        ->where('agent_id', $this->agent->id)->latest()->get();
    }
    

    }

    public function updatedSelectedFolder($selected_folder_id){

        if(!is_null($selected_folder_id)){
            if ($this->category == "customer") {
                $this->customer = Customer::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('customer_id', $this->customer->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "employee") {
                $this->employee = Employee::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('employee_id', $this->employee->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "department") {
                $this->department = Department::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('department_id', $this->department->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "consignee") {
                $this->consignee = Consignee::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('consignee_id', $this->consignee->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "incident") {
                $this->incident = Incident::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('incident_id', $this->incident->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "route") {
                $this->route = Route::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('route_id', $this->route->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "loading_point") {
                $this->loading_point = LoadingPoint::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('loading_point_id', $this->loading_point->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "offloading_point") {
                $this->offloading_point = OffloadingPoint::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('offloading_point_id', $this->offloading_point->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "truck_stop") {
                $this->truck_stop = TruckStop::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('truck_stop_id', $this->truck_stop->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "horse") {
                $this->horse = Horse::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('horse_id', $this->horse->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "trailer") {
                $this->trailer = Trailer::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('trailer_id', $this->trailer->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "requisition") {
                $this->requisition = Requisition::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('requisition_id', $this->requisition->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "vehicle") {
                $this->vehicle = Vehicle::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('vehicle_id', $this->vehicle->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "company") {
                $this->company = Company::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('company_id', $this->company->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "cash_flow") {
                $this->cash_flow = CashFlow::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('cash_flow_id', $this->cash_flow->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "recovery") {
                $this->recovery = Recovery::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('recovery_id', $this->recovery->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "payment") {
                $this->payment = Payment::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('payment_id', $this->payment->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "asset") {
                $this->asset = Asset::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('asset_id', $this->asset->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "clearing_agent") {
                $this->clearing_agent = ClearingAgent::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('clearing_agent_id', $this->clearing_agent->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "purchase") {
                $this->purchase = Purchase::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('purchase_id', $this->purchase->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "vendor") {
                $this->vendor = Vendor::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('vendor_id', $this->vendor->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "broker") {
                $this->broker = Broker::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('broker_id', $this->broker->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "transporter") {
                $this->transporter = Transporter::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('transporter_id', $this->transporter->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
            elseif ($this->category == "agent") {
                $this->agent = Agent::find($this->item_id);
                $this->documents = Document::where('category', $this->category)
                ->where('agent_id', $this->agent->id)
                ->where('folder_id', $selected_folder_id)
                ->latest()->get();
            }
        }
    }

    public function showDocumentDelete($id){
        $this->document_id = $id;
        $this->document = Document::find($id);
        $this->dispatchBrowserEvent('show-documentDeleteModal');
    }
    public function deleteDocument(){
        $this->document->delete();
        $this->resetInputFields();
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=>"Document Deleted Successfully Successfully!!"
        ]);
        $this->dispatchBrowserEvent('hide-documentDeleteModal');
    }

    public function showFolderDelete($id){
        $this->folder_id = $id;
        $this->folder = Folder::find($id);
        $this->dispatchBrowserEvent('show-folderDeleteModal');
    }
    public function deleteFolder(){
        $documents = $this->folder->documents;
        if (isset($documents)) {
            foreach ($documents as $document) {
                $document->delete();
            }
        }
        $this->folder->delete();
        $this->resetInputFields();
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=>"Folder Deleted Successfully Successfully!!"
        ]);
        $this->dispatchBrowserEvent('hide-folderDeleteModal');
    }
    public function showFolder(){
        $this->dispatchBrowserEvent('show-folderModal');
    }

    public function storeFolder(){
        try{

            $folder = new Folder;
            $folder->user_id = Auth::user()->id;
            $folder->category = $this->category;
            $folder->title = $this->folder_title;
            $folder->save();

            $this->folder_id = $folder->id;

            $this->dispatchBrowserEvent('hide-folderModal');
            $this->resetInputFields();
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"Folder Created Successfully!!"
            ]);

        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
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

            $this->dispatchBrowserEvent('hide-folderEditModal');
            $this->resetInputFields();
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"Folder Updated Successfully!!"
            ]);

        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
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

            if (isset($this->customer)) {
                $document->customer_id = $this->customer->id;
            }
            elseif (isset($this->employee)) {
                $document->employee_id = $this->employee->id;
            }
            elseif (isset($this->route)) {
                $document->route_id = $this->route->id;
            }
            elseif (isset($this->truck_stop)) {
                $document->truck_stop_id = $this->truck_stop->id;
            }
            elseif (isset($this->department)) {
                $document->department_id = $this->department->id;
            }
            elseif (isset($this->consignee)) {
                $document->consignee_id = $this->consignee->id;
            }
            elseif (isset($this->offloading_point)) {
                $document->offloading_point_id = $this->offloading_point->id;
            }
            elseif (isset($this->loading_point)) {
                $document->loading_point_id = $this->loading_point->id;
            }
            elseif (isset($this->incident)) {
                $document->incident_id = $this->incident->id;
            }
            elseif (isset($this->recovery)) {
                $document->recovery_id = $this->recovery->id;
            }
            elseif (isset($this->horse)) {
                $document->horse_id = $this->horse->id;
            }
            elseif (isset($this->trailer)) {
                $document->trailer_id = $this->trailer->id;
            }
            elseif (isset($this->requisition)) {
                $document->requisition_id = $this->requisition->id;
            }
            elseif (isset($this->vehicle)) {
                $document->vehicle_id = $this->vehicle->id;
            }
            elseif (isset($this->cash_flow)) {
                $document->cash_flow_id = $this->cash_flow->id;
            }
            elseif (isset($this->company)) {
                $document->company_id = $this->company->id;
            }
            elseif (isset($this->payment)) {
                $document->payment_id = $this->payment->id;
            }
            elseif (isset($this->purchase)) {
                $document->purchase_id = $this->purchase->id;
            }
            elseif (isset($this->asset)) {
                $document->asset_id = $this->asset->id;
            }
            elseif (isset($this->transporter)) {
                $document->transporter_id = $this->transporter->id;
            }
            elseif (isset($this->agent)) {
                $document->agent_id = $this->agent->id;
            }
            elseif (isset($this->clearing_agent)) {
                $document->clearing_agent_id = $this->clearing_agent->id;
            }
            elseif (isset($this->broker)) {
                $document->broker_id = $this->broker->id;
            }
            elseif (isset($this->vendor)) {
                $document->vendor_id = $this->vendor->id;
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

         

            $this->dispatchBrowserEvent('hide-documentModal');
            $this->resetInputFields();
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"Document(s) Uploaded Successfully!!"
            ]);

        // }catch(\Exception $e){
        //     // Set Flash Message
        //     $this->dispatchBrowserEvent('alert',[
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

        $this->dispatchBrowserEvent('show-folderEditModal');

        }

    public function edit($id){

        $document = Document::find($id);
        $this->user_id = $document->user_id;
        $this->title = $document->title;
        $this->expires_at = $document->expiry_date;
        $this->filename = $document->filename;
        $this->document_id = $document->id;

        $this->dispatchBrowserEvent('show-documentEditModal');

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

                $this->dispatchBrowserEvent('hide-documentEditModal');
                $this->resetInputFields();
                $this->dispatchBrowserEvent('alert',[
                    'type'=>'success',
                    'message'=>"Document Updated Successfully!!"
                ]);
            }catch(\Exception $e){
                // Set Flash Message
                $this->dispatchBrowserEvent('alert',[
                    'type'=>'error',
                    'message'=>"Something went wrong while updating document(s)!!"
                ]);
            }

            }
        }


    public function render()
    {
            $this->folders = Folder::latest()->get();
            $this->documents = Document::latest()->get();
     
        return view('livewire.documents.index',[
            'documents'=> $this->documents,
            'folders'=> $this->folders
        ]);
    }
}
