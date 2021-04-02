@extends('layouts.appmaster')
@section('title', 'Profile Page')

@section('content')
<div class="profile-content">
        {{-- User Profile --}}
        <div class="container">
            <h1>My Profile</h1>

            <div class="row my-2" id="profile">
                <div class="col-lg-2 order-lg-1 text-center">
                    <img src="images/user.jpg" class="mx-auto img-fluid img-circle d-block" alt="avatar">
                    {{-- <h6 class="mt-2">Upload a different photo</h6>
                    <label class="custom-file">
                        <input type="file" id="file" class="custom-file-input">
                        <span class="custom-file-control">Choose file</span>
                    </label> --}}
                </div>
                <div class="col-lg-8 order-lg-2">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Profile</a>
                        </li>

                        @if(count($profile) != 0)
                        <li class="nav-item">
                            <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Edit</a>
                        </li>
                        @endif
                    </ul>
                    <div class="tab-content py-4">
                        <div class="tab-pane active" id="profile">
                            @if(count($profile) != 0)
                                @foreach($profile as $c)
                                    <h5 class="mb-3">{{$c->getName()}} | <small>{{$c->getCountry()}}</small></h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>About Me</h6>
                                            <p>{{$c->getAbout()}}</p>
                                        </div>
                                    </div>
                                    @endforeach
                            @else
                                <h4>Add Your Profile Information Here: </h4>
                                <form role="form" action="addProfile" method="POST">
                                    <input type="hidden" name="_token" value = "<?php echo csrf_token()?>">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Name</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="" name="name" required="required">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Where I'm From</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="" name="country" required="required">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">About Me</label>
                                        <div class="col-lg-9">
                                            <textarea class="form-control" name="about" placeholder="" required="required" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-9">
                                            <input type="submit" class="btn btn-primary" value="Save Changes">
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                        @if(count($profile) != 0)
                            @foreach($profile as $p)
                                <div class="tab-pane" id="edit">
                                    <form role="form" action="updateProfile" method="POST">
                                        <input type="hidden" name="_token" value = "<?php echo csrf_token()?>">
                                        <input type="hidden" name="id" value='{{$p->getId()}}'/>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Name</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text" name="name" value="{{$p->getName()}}" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Where I'm From</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text" name="country" value="{{$p->getCountry()}}" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">About Me</label>
                                            <div class="col-lg-9">
                                                <textarea class="form-control" name="about" placeholder="" required="required" rows="3">{{$p->getAbout()}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label"></label>
                                            <div class="col-lg-9">
                                                <input type="submit" class="btn btn-primary" value="Save Changes">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @endforeach
                            @endif
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <hr>

        {{-- Recent Travels --}}

<div class="travels">
        <h3>Recent Travels <i class="fas fa-plus" data-toggle="modal" data-target="#myModal"></i></h3>
        <div class="container">
            <div class="row">
                @if(count($travel) != 0)
                    @foreach($travel as $p)
                        <div class="col-md-4">
                            <div class="card-content">
                                <div class="card-img">
                                    <img src="images/{{$p->getImage()}}" alt="">
                                </div>
                                <div class="card-desc">
                                    <h3>{{$p->getDestination()}}</h3>
                                    <p align="center"><small>{{date('m/d/Y', strtotime($p->getDeparture()))}} to {{date('m/d/Y', strtotime($p->getReturn()))}}</small></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @else
                        <h5>Click the "+" to add any recent travels!</h5>
                @endif
            </div>
        </div>
</div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel" style="float: left">Add Recent Travel</h4>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form action="addRecentTravel" method="POST">
                <input type="hidden" name="_token" value = "<?php echo csrf_token()?>">
                <div class="form-group">
                    <label for="birthday">Destination:</label>
                    <input type="text" class="form-control" name="destination" placeholder="Destination" required="required">
                </div>
                <div class="form-group">
                    <label for="departure">Departure:</label>
                    <input type="date" id="departure_date" name="departure_date" required="required">
                </div>
                <div class="form-group">
                    <label for="return">Return:</label>
                    <input type="date" id="return_date" name="return_date" required="required">
                </div>
                <div class="form-group">
                    <input type="file" id="myFile" name="image" required="required">
                </div>
                <div class="form-group">
                    <input type="hidden" name="user_id"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
            </form>
        </div>
      </div>
  </div>

@endsection
