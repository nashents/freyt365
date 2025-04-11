<div>
    <x-loading/>
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
                            <div class="profile-user-img"><img src="{{asset('images/uploads/'.$user->profile)}}" alt=""
                                    class="avatar-lg rounded-circle"></div>
                            <div class="">
                                <h4 class="mt-4 fs-17 ellipsis">{{$user->name}} {{$user->surname}}</h4>
                                <p class="font-13">
                                   {{$user->roles->first()->name}}
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
                                            <div class="row row-cols-sm-2 row-cols-1">
                                                <div class="mb-2">
                                                    <label class="form-label" for="FullName">Name
                                                        </label>
                                                    <input type="text" wire:model.live.debounce.300ms="name" 
                                                        class="form-control">
                                                        @error('name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label" for="FullName">Surname
                                                        </label>
                                                    <input type="text" wire:model.live.debounce.300ms="surname" 
                                                        class="form-control">
                                                        @error('surname') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="Email">Email</label>
                                                    <input type="email"  class="form-control" wire:model.live.debounce.300ms="email" >
                                                    @error('email') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="web-url">Phonenumber</label>
                                                    <input type="text"  class="form-control" wire:model.live.debounce.300ms="phonenumber" >
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="Username">Username</label>
                                                    <input type="text"
                                                        class="form-control" required wire:model.live.debounce.300ms="username" >
                                                        @error('userma,e') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="Current Password">Current Password</label>
                                                    <input type="current_password" required wire:model.live.debounce.300ms="current_password"  class="form-control" >
                                                    <small>Specify your current password to change your credentials.</small>
                                                    <br>
                                                    @error('current_password') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="Password">New Password</label>
                                                    <input type="password" required wire:model.live.debounce.300ms="password"  class="form-control">
                                                    <small>The password needs to be a minimum of 8 characters and must contain at least one non-alphanumeric character.</small>
                                                    <br>
                                                    @error('password') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="PassowordConfirmation">Confirm-Password</label>
                                                    <input type="password" required wire:model.live.debounce.300ms="password_confirmation"  class="form-control">
                                                    @error('password_confirmation') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
