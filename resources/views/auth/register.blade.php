@extends('layouts.auth', ['title' => 'Register'])

@section('content')

<form action="{{url('register')}}" method="POST" class="form-signin" enctype="multipart/form-data">
    @csrf
    <img class="mb-4" src="/docs/4.4/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
    <label for="password_confirmation" class="sr-only">Confirm password</label>
    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
    <label for="firstname" class="sr-only">First name</label>
    <input type="text" id="inputFirstname" class="form-control" name="firstname" placeholder="First name" required>
    <label for="lastname" class="sr-only">Last name</label>
    <input type="text" id="inputlastname" class="form-control" name="lastname" placeholder="Last name" required>
    <label for="phone_number" class="sr-only">Phone number</label>
    <input type="text" id="inputPhone_number" class="form-control" name="phone_number" placeholder="Phone number" required>
    <label for="profile_url" class="sr-only">profile url</label>
    <input type="file" id="inputprofile_url" class="form-control" name="profile_url" placeholder="Profile url">
    
    
    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
    <a href="{{route('login')}}">Click here if you have an account</a>
    <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
</form>

@endsection