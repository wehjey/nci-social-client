@extends('layouts.master', ['title' => 'My Profile'])

@section('style')
    <style>
      .card-text {
        font-size: 16px
      }
    </style>
@endsection

@section('content')
  <!-- Page Header -->
  <header class="masthead" style="background-image: url({{url('main/img/home-bg.jpg')}})">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>Hi {{session('user')['firstname']}} </h1>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-10 mx-auto">
          
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="details-tab" data-toggle="tab" href="{{url('my')}}" role="tab" aria-controls="home" aria-selected="true">My Details</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="topics-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">My Topics</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="products-tab" data-toggle="tab" href="#product" role="tab" aria-controls="product" aria-selected="false">My Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="orders-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">My Orders</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                @include('shared.alerts')
                <p>
                  @if ($user['profile_url'])
                    <img src="{{$user['profile_url']}}" class="img-thumbnail" alt="">
                  @else
                    <img src="https://via.placeholder.com/100" class="img-thumbnail" alt="">
                  @endif
                </p>
                <p>Name: {{ucwords($user['firstname']. ' ' . $user['lastname'])}}</p>
                <p>Email: {{$user['email']}}</p>
                <p>Phone Number: {{$user['phone_number']}}</p>
                <p>
                  <button id="modalBtn" type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                    Edit Details
                  </button>
                </p>
              </div>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
            </div>
        </div>
      </div>
    </div>
  </article>


  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="error" class="alert alert-danger d-none" role="alert">
              Please fill in all required fields
          </div>
        <form id="form" action="{{url('profile')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="fname">First Name <i class="text-danger">*</i></label>
            <input type="text" class="form-control" id="fnmae" name="firstname" value="{{$user['firstname']}}" placeholder="Enter first name" required>
          </div>
          <div class="form-group">
            <label for="lname">Last Name <i class="text-danger">*</i></label>
            <input type="text" class="form-control" id="lnmae" name="lastname" value="{{$user['lastname']}}" placeholder="Enter last name" required>
          </div>
          <div class="form-group">
            <label for="tel">Phone number <i class="text-danger">*</i></label>
            <input type="tel" class="form-control" id="tel" name="phone_number" value="{{$user['phone_number']}}" placeholder="Enter phone number" required>
          </div>
          <div class="form-group">
            <label for="file">Add Profile Photo</label>
            <input type="file" class="form-control" id="file" name="profile_url">
          </div>
          <button type="submit" id="submit" class="btn btn-warning">Save Changes</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
    @include('shared.nav_script')
@endsection
