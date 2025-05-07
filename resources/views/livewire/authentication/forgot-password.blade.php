<div>
    <!-- form -->
    <form wire:submit.prevent="submit()">
        <div class="mb-3">
            <label for="emailaddress" class="form-label">Email address<span class="required" style="color: red">*</span></label>
            <input class="form-control" type="email" wire:model.live.debounce.300ms="email" required
                placeholder="Enter your email">
                @error('email') <span class="error" style="color:red">{{ $message }}</span> @enderror
        </div>
        
        <div class="mb-0 text-start">
            <button class="btn btn-soft-primary w-100" type="submit"><i class="ri-loop-left-line me-1 fw-bold"></i> <span class="fw-bold">Send Password Reset Link</span> </button>
        </div>
    </form>
    <!-- end form-->
</div>
