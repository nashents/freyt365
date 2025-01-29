<div>
    <x-loading/>
    <form wire:submit.prevent="store()" action="#">
        <h5 class="underline mt-30">Company Details</h5> 
        <br>
        <div class="mb-3">
            <label for="fullname" class="form-label">Company Name<span class="required" style="color: red">*</span></label>
            <input class="form-control" type="text"  wire:model.live.debounce.300ms="company_name"
                placeholder="Enter your company name" required>
                @error('company_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Company Email<span class="required" style="color: red">*</span></label>
                    <input class="form-control" type="email"  wire:model.live.debounce.300ms="company_email"
                        placeholder="Enter your company email" required>
                        @error('company_email') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Company Phonenumber<span class="required" style="color: red">*</span></label>
                    <input class="form-control" type="text"  wire:model.live.debounce.300ms="company_phonenumber"
                        placeholder="Enter your company phonenumber" required>
                        @error('company_phonenumber') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Country<span class="required" style="color: red">*</span></label>
                   <select  class="form-control" type="text"  wire:model.live.debounce.300ms="country" required>
                        <option value="">Select Country</option>
                        @foreach ($countries as $country)
                           <option value=" {{$country->name}}"> <img src="{{asset('images/flags/'.$country->flag)}}" alt=""> {{$country->name}}</option>
                        @endforeach
                   </select>
                        @error('country') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fullname" class="form-label">City<span class="required" style="color: red">*</span></label>
                    <input class="form-control" type="text"  wire:model.live.debounce.300ms="city"
                        placeholder="Enter your company city" required>
                        @error('city') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Suburb<span class="required" style="color: red">*</span></label>
                    <input class="form-control" type="text"  wire:model.live.debounce.300ms="suburb"
                        placeholder="Enter your company suburb" required>
                        @error('suburb') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Street Address<span class="required" style="color: red">*</span></label>
                    <input class="form-control" type="text"  wire:model.live.debounce.300ms="street_address"
                        placeholder="Enter your company street address" required>
                        @error('street_address') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
       
      


        <h5 class="underline mt-30">User Details</h5> 
        <br>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Name<span class="required" style="color: red">*</span></label>
                    <input class="form-control" type="text"  wire:model.live.debounce.300ms="name"
                        placeholder="Enter your name" required>
                        @error('name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Last Name<span class="required" style="color: red">*</span></label>
                    <input class="form-control" type="text" wire:model.live.debounce.300ms="surname"
                        placeholder="Enter your last name" required>
                        @error('surname') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
      <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="emailaddress" class="form-label">Phonenumber</label>
                <input class="form-control" type="text"  wire:model.live.debounce.300ms="phonenumber" 
                    placeholder="Enter your phonenumber">
                    @error('phonenumber') <span class="error" style="color:red">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="emailaddress" class="form-label">Email Address<span class="required" style="color: red">*</span></label>
                <input class="form-control" type="email"  wire:model.live.debounce.300ms="email" required
                    placeholder="Enter your email">
                    @error('email') <span class="error" style="color:red">{{ $message }}</span> @enderror
            </div>
        </div>
      </div>

        <div class="mb-3" >
            <label for="name">Select what to use as your username?</label>
            <br>
            <label class="radio-inline mt-2">
                <input type="radio" wire:model.debounce.300ms="use_email_as_username" value="Email" name="optradio" >Email
              </label>
              <label class="radio-inline mt-2">
                <input type="radio" wire:model.debounce.300ms="use_email_as_username" value="Phonenumber" name="optradio">Phonenumber
              </label>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="password" class="form-label">Password<span class="required" style="color: red">*</span></label>
                    <input class="form-control" type="password" required wire:model.live.debounce.300ms="password"
                        placeholder="Enter your password">
                        @error('password') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="password" class="form-label">Confirm Password<span class="required" style="color: red">*</span></label>
                    <input class="form-control" type="password" required wire:model.live.debounce.300ms="password_confirmation" 
                        placeholder="Confirm your password">
                        @error('password_confirmation') <span class="error" style="color:red">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input type="checkbox" class="form-check-input"
                    id="checkbox-signup" required>
                <label class="form-check-label" for="checkbox-signup">By checking this box i agree to Freyt365`s <a
                        href="{{asset('freyt365_terms_conditions.pdf')}}" target="_blank">Terms and
                        Conditions</a> and <a href="{{asset('privacy_policy.pdf')}}" target="_blank">Privacy Policy</a><span class="required" style="color: red">*</span></label>
            </div>
        </div>
        <div class="mb-0 d-grid text-center">
            <button class="btn btn-primary fw-semibold" type="submit">Sign
                Up</button>
        </div>

    </form>
</div>
