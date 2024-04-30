<div>
    <form wire:submit.prevent="store()" action="#">
        <h5 class="underline mt-30">Company Details</h5> 
        <br>
        <div class="mb-3">
            <label for="fullname" class="form-label">Company Name<span class="required" style="color: red">*</span></label>
            <input class="form-control" type="text"  wire:model.live.debounce.300ms="company_name"
                placeholder="Enter your company name" required>
                @error('company_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="fullname" class="form-label">Company Email</label>
            <input class="form-control" type="email"  wire:model.live.debounce.300ms="company_email"
                placeholder="Enter your company email" >
                @error('company_email') <span class="error" style="color:red">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="fullname" class="form-label">Company Phonenumber</label>
            <input class="form-control" type="text"  wire:model.live.debounce.300ms="company_phonenumber"
                placeholder="Enter your company phonenumber" >
                @error('company_phonenumber') <span class="error" style="color:red">{{ $message }}</span> @enderror
        </div>


        <h5 class="underline mt-30">User Details</h5> 
        <br>

        <div class="mb-3">
            <label for="fullname" class="form-label">Name<span class="required" style="color: red">*</span></label>
            <input class="form-control" type="text"  wire:model.live.debounce.300ms="name"
                placeholder="Enter your name" required>
                @error('name') <span class="error" style="color:red">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="fullname" class="form-label">Last Name<span class="required" style="color: red">*</span></label>
            <input class="form-control" type="text" wire:model.live.debounce.300ms="surname"
                placeholder="Enter your last name" required>
                @error('surname') <span class="error" style="color:red">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="emailaddress" class="form-label">Phonenumber</label>
            <input class="form-control" type="text"  wire:model.live.debounce.300ms="phonenumber" 
                placeholder="Enter your phonenumber">

                @error('phonenumber') <span class="error" style="color:red">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="emailaddress" class="form-label">Email address<span class="required" style="color: red">*</span></label>
            <input class="form-control" type="email"  wire:model.live.debounce.300ms="email" required
                placeholder="Enter your email">
                @error('email') <span class="error" style="color:red">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="name">Username?</label> <br>
                <label class="radio-inline">
                    <input type="radio" wire:model.live.debounce.300ms="use_email_as_username" value="email" name="optradio" >Email
                  </label>
                  <label class="radio-inline">
                    <input type="radio" wire:model.live.debounce.300ms="use_email_as_username" value="phonenumber" name="optradio">Phonenumber
                  </label>
                  @error('use_email_as_username') <span class="error" style="color:red">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password<span class="required" style="color: red">*</span></label>
            <input class="form-control" type="password" required wire:model.live.debounce.300ms="password"
                placeholder="Enter your password">
                @error('password') <span class="error" style="color:red">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Confirm Password<span class="required" style="color: red">*</span></label>
            <input class="form-control" type="password" required wire:model.live.debounce.300ms="password_confirmation" 
                placeholder="Confirm your password">
                @error('password_confirmation') <span class="error" style="color:red">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input type="checkbox" class="form-check-input"
                    id="checkbox-signup">
                <label class="form-check-label" for="checkbox-signup">I accept <a
                        href="javascript: void(0);" class="text-muted">Terms and
                        Conditions</a></label>
            </div>
        </div>
        <div class="mb-0 d-grid text-center">
            <button class="btn btn-primary fw-semibold" type="submit">Sign
                Up</button>
        </div>

    </form>
</div>
