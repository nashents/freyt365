<div>
    <x-loading/>
    <div class="row">
        <div class="col-sm-12">
            <div class="card p-0">
                <div class="card-body p-0">
                    <div class="profile-content">
                        <ul class="nav nav-underline nav-justified gap-0">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#details" type="button" role="tab"
                                    aria-controls="home" aria-selected="true" href="#details">Company Details</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#documents" type="button" role="tab"
                                    aria-controls="home" aria-selected="true"
                                    href="#documents">Company Documents</a></li>
                         
                        </ul>

                        <div class="tab-content m-0 p-4">
                            <div class="tab-pane active" id="details" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">
                                <div class="profile-desk">
                                    <table class="table table-condensed mb-0 border-top">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Name</th>
                                                <td>
                                                    <a href="#" class="ng-binding">
                                                       {{$company->name}}
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Email</th>
                                                <td>
                                                    <a href="#" class="ng-binding">
                                                       {{$company->email}}
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">No-Reply</th>
                                                <td>
                                                    <a href="#" class="ng-binding">
                                                       {{$company->noreply}}
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Phonenumber</th>
                                                <td>
                                                    <a href="#" class="ng-binding">
                                                       {{$company->phonenumber}}
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Address</th>
                                                <td>
                                                    <a href="" class="ng-binding">
                                                        {{$company->street_address}} {{$company->street_address}} {{$company->suburb}}, {{$company->city}} {{$company->country}}
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end profile-desk -->
                            </div> <!-- about-me -->

                            <!-- Activities -->
                            <div id="documents" class="tab-pane">
                                @livewire('documents.index', ['category' => 'company','id' => $company->id])
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
</div>
