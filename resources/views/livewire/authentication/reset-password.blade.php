<div>
    <!-- form -->
    <form wire:submit.prevent="resetPassword()">
        <div class="mb-3">
            <label for="emailaddress" class="form-label">Email<span class="required" style="color: red">*</span></label>
            <input class="form-control" type="email" wire:model.live.debounce.300ms="email" placeholder="Enter your email" required>
            @error('email') <span class="error" style="color:red">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">New Password<span class="required" style="color: red">*</span></label>
            <input class="form-control" type="password" wire:model.live.debounce.300ms="password"  placeholder="New Password" required>
            @error('password') <span class="error" style="color:red">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="confirm" class="form-label">Confirm Password<span class="required" style="color: red">*</span></label>
            <input class="form-control" type="password" wire:model.live.debounce.300ms="password_confirmation" placeholder="Confirm Password" required>
                @error('password_confirmation') <span class="error" style="color:red">{{ $message }}</span> @enderror
        </div>
        
        <div class="mb-0 text-start">
            <button class="btn btn-soft-primary w-100" type="submit"><i class="ri-loop-left-line me-1 fw-bold"></i> <span class="fw-bold">Reset Password</span> </button>
        </div>
    </form>
    <!-- end form-->
</div>
