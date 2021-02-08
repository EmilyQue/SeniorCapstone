@extends('layouts.appmaster')
@section('title', 'Profile Page')

@section('content')
<div class="profile-content">
    <div class="shadow-box">
        {{-- User Profile --}}
        <div class="container">
            <div class="row my-2">
                <div class="col-lg-8 order-lg-2">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Edit</a>
                        </li>
                    </ul>
                    <div class="tab-content py-4">
                        <div class="tab-pane active" id="profile">
                            <h5 class="mb-3">Emily Quevedo | <small>Phoenix, Arizona</small></h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>About Me</h6>
                                    <p>
                                        Hi! My name is Emily and I enjoy travelling. I love to share both personal and professional travel experiences in an honest blog post.
                                        I've visited many destinations around the world including Rome, Athens, London, Peru, Amsterdam and many more! I aim to inspire fellow travellers to pursue their dream in traveling.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="edit">
                            <form role="form">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">First name</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Last name</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="email" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-6">
                                        <input class="form-control" type="text" value="" placeholder="">
                                    </div>
                                    <div class="col-lg-3">
                                        <input class="form-control" type="text" value="" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Username</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Password</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="password" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9">
                                        <input type="reset" class="btn btn-secondary" value="Cancel">
                                        <input type="button" class="btn btn-primary" value="Save Changes">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 order-lg-1 text-center">
                    <img src="images/user.jpg" class="mx-auto img-fluid img-circle d-block" alt="avatar">
                    {{-- <h6 class="mt-2">Upload a different photo</h6>
                    <label class="custom-file">
                        <input type="file" id="file" class="custom-file-input">
                        <span class="custom-file-control">Choose file</span>
                    </label> --}}
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <hr>

        {{-- Recent Travels --}}

<div class="travels">
        <h3>Recent Travels</h3>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card-content">
                        <div class="card-img">
                            <img src="images/machupicchu.jpg" alt="">
                        </div>
                        <div class="card-desc">
                            <h3>Machu Picchu, Peru</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-content">
                        <div class="card-img">
                            <img src="images/rome.jpg" alt="">
                        </div>
                        <div class="card-desc">
                            <h3>Rome, Italy</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-content">
                        <div class="card-img">
                            <img src="images/london.jpg" alt="">
                        </div>
                        <div class="card-desc">
                            <h3>London, United Kingdom</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
    </div>
</div>

@endsection
