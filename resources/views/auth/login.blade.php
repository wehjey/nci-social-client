@extends('layouts.auth', ['title' => 'Login'])

@section('content')

<form action="{{url('login')}}" method="POST" class="form-signin" autocomplete="off">
    @csrf
    <img class="mb-4" src="{{url('images/logo.jpeg')}}" alt="" width="200" height="200">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in NCI Social</h1>

    @include('shared.alerts')

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
    <div class="checkbox mb-3">
        <label>
        <input type="checkbox" value="remember_me" name="remember"> Remember me
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <a href="{{route('register')}}">Create an account</a>
    <p class="mt-5 mb-3 text-muted">&copy; {{date('Y')}}</p>
</form>

@endsection