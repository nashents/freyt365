<div>
    <form wire:submit.prevent="store()" action="#">
        <div class="mb-3">
            <label for="fullname" class="form-label">Company Name<span class="required" style="color: red">*</span></label>
            <input class="form-control" type="text"  wire:model.debounce.300ms="company_name"
                placeholder="Enter your company name" required>
        </div>
        <div class="mb-3">
            <label for="fullname" class="form-label">Company Email</label>
            <input class="form-control" type="email"  wire:model.debounce.300ms="company_email"
                placeholder="Enter your company email" >
        </div>
        <div class="mb-3">
            <label for="fullname" class="form-label">Company Phonenumber</label>
            <input class="form-control" type="text"  wire:model.debounce.300ms="company_phonenumber"
                placeholder="Enter your company phonenumber" >
        </div>
        <div class="mb-3">
            <label for="fullname" class="form-label">Name<span class="required" style="color: red">*</span></label>
            <input class="form-control" type="text"  wire:model.debounce.300ms="name"
                placeholder="Enter your name" required="">
        </div>
        <div class="mb-3">
            <label for="fullname" class="form-label">Last Name<span class="required" style="color: red">*</span></label>
            <input class="form-control" type="text" wire:model.debounce.300ms="surname"
                placeholder="Enter your last name" required="">
        </div>
        <div class="mb-3">
            <label for="emailaddress" class="form-label">Phonenumber</label>
            <input class="form-control" type="text"  wire:model.debounce.300ms="phonenumber" 
                placeholder="Enter your phonenumber">
        </div>
        <div class="mb-3">
            <label for="emailaddress" class="form-label">Email address<span class="required" style="color: red">*</span></label>
            <input class="form-control" type="email"  wire:model.debounce.300ms="email" required=""
                placeholder="Enter your email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password<span class="required" style="color: red">*</span></label>
            <input class="form-control" type="password" required="" wire:model.debounce.300ms="password"
                placeholder="Enter your password">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Confirm Password<span class="required" style="color: red">*</span></label>
            <input class="form-control" type="password" required="" wire:model.debounce.300ms="password_confirmation" 
                placeholder="Confirm your password">
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
