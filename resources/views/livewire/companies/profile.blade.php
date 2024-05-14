<div>
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="profile-bg-picture"
                    style="background-image:url('{{asset('images/bg-profile.jpg')}}')">
                    <span class="picture-bg-overlay"></span>
                    <!-- overlay -->
                </div>
                <!-- meta -->
                <div class="profile-user-box">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="profile-user-img"><img src="{{asset('images/uploads/'.$company->logo)}}" alt=""
                                    class="avatar-lg rounded-circle"></div>
                            <div class="">
                                <h4 class="mt-4 fs-17 ellipsis">{{$company->name}}</h4>
                                <p class="font-13">
                                   {{ucfirst($company->type)}}
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex justify-content-end align-items-center gap-2">
                               
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ meta -->
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card p-0">
                    <div class="card-body p-0">
                        <div class="profile-content">
                            <ul class="nav nav-underline nav-justified gap-0">
                                <div class="col-md-3">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#aboutme" type="button" role="tab"
                                            aria-controls="home" aria-selected="true" href="#aboutme"  >
                                            <span style="margin-left: -10%">About</span>
                                        </a>
                                    </li>
                                </div>
                               
                              
                            </ul>

                            <div class="tab-content m-0 p-4">
                                <div class="tab-pane active" id="aboutme" role="tabpanel"
                                    aria-labelledby="home-tab" tabindex="0">
                                    <div class="user-profile-content">
                                        <form wire:submit.prevent="update()">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="name">Name<span class="required" style="color: red">*</span></label>
                                                        <input type="text" class="form-control" wire:model.debounce.300ms="name" required>
                                                        @error('name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                        </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="color">Color</label>
                                                        <input type="color" class="form-control"  wire:model.debounce.300ms="color" class="form-control">
                                                        @error('color') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                               
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="email">Email<span class="required" style="color: red">*</span></label>
                                                            <input type="email" class="form-control"  wire:model.debounce.300ms="email" placeholder="Email used to receive emails" required>
                                                            @error('email') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                            </div>  
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="phonenumber">Phonenumber<span class="required" style="color: red">*</span></label>
                                                            <input type="text" class="form-control" wire:model.debounce.300ms="phonenumber" required>
                                                            @error('phonenumber') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="email">No Reply Email<span class="required" style="color: red">*</span></label>
                                                            <input type="email" class="form-control"  wire:model.debounce.300ms="noreply" placeholder="Email used to send emails" disabled required>
                                                            @error('noreply') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="email">ERP URL<span class="required" style="color: red">*</span></label>
                                                            <input type="text" class="form-control"  wire:model.debounce.300ms="website" placeholder="ERP URL eg http://www.erp.gonyetilts.co.zw" required disabled>
                                                            @error('website') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="vat">Currencies<span class="required" style="color: red">*</span></label>
                                                          <select class="form-control" wire:model.debounce.300ms="currency_id" required>
                                                                <option value="">Select Trading Currency</option>
                                                                @foreach ($currencies as $currency)
                                                                    <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                                                @endforeach
                                                          </select>
                                                            @error('currency_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="vat">VAT %</label>
                                                            <input type="number" step="any" class="form-control" wire:model.debounce.300ms="vat" placeholder="%" >
                                                            @error('vat') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                  
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="one" class="radio-label">Vat Number</label>
                                                        <input type="text" class="form-control"  wire:model.debounce.300ms="vat_number" placeholder="Enter VAT Number">
                                                        @error('vat_number') <span class="text-danger error">{{ $message }}</span>@enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="one" class="radio-label">TIN Number</label>
                                                        <input type="text" class="form-control"  wire:model.debounce.300ms="tin_number" placeholder="Enter TIN Number" >
                                                        @error('tin_number') <span class="text-danger error">{{ $message }}</span>@enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="period">Fiscalize Invoices</label>
                                                            <select class="form-control"wire:model.debounce.300ms="fiscalize">
                                                                <option value="" disabled>Choose Option</option>
                                                                <option value="1">Yes</option>
                                                                <option value="0">No</option>
                                                            </select>
                                                            @error('fiscalize') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                              
                                               
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="country">Country</label>
                                                            <input type="text" class="form-control"  wire:model.debounce.300ms="country" >
                                                            @error('country') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="city">City/Town</label>
                                                            <input type="text" class="form-control"  wire:model.debounce.300ms="city" >
                                                         @error('city') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="suburb">Suburb</label>
                                                            <input type="text" class="form-control"  wire:model.debounce.300ms="suburb">
                                                            @error('suburb') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="street_address">Street Address</label>
                                                            <input type="text" class="form-control"  wire:model.debounce.300ms="street_address">
                                                            @error('street_address') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                              
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1">Invoice Notes  / Terms & Conditions</label>
                                                           <textarea wire:model.debounce.300ms="invoice_memo" cols="30" rows="5" class="form-control" placeholder="Enter invoice notes or terms of service that are visible to your customer"></textarea>
                                                           @error('invoice_memo') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="invoice_footer">Invoice Footer</label>
                                                           <textarea wire:model.debounce.300ms="invoice_footer" cols="30" rows="5" class="form-control" placeholder="Enter footer for your invoices eg (Tax Information / Thank you note)"></textarea>
                                                           @error('invoice_footer') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                              
                                             
                                                <button class="btn btn-primary" type="submit"><i
                                                    class="ri-save-line me-1 fs-16 lh-1"></i> Update</button>
                                               
                                                
                                               
                                        </form>
                                    </div>
                                </div> <!-- about-me -->

                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

    </div>
</div>
