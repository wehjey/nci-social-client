@extends('layouts.master', ['title' => 'New Books'])

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
            <h1>New Books <i class="fa fa-book" aria-hidden="true"></i></h1>
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

          <h3 class="section-heading float-left" style="margin:20px 0">New Books</h3>
          <div class="float-right">
            <form class="form-inline" action="{{url('books/search')}}" method="GET">
              <div class="form-group mx-sm-3 mb-2">
                <label for="inputPassword2" class="sr-only">Keyword</label>
                <input type="text" class="form-control" name="keyword" value="{{request('keyword')}}" id="inputPassword2" placeholder="Search...">
              </div>
              <button type="submit" class="btn btn-dark btn-sm mb-2">
                <i class="fa fa-search"></i>
              </button>
            </form>
          </div>
          <div class="clearfix"></div>

          <hr>
          <div class="row">
            @foreach($books as $book)
            <div class="col-3">
              <div class="card" style="width: 16rem; margin-bottom: 20px">
                <img class="card-img-top" src="{{$book['image']}}" alt="{{$book['title']}}">
                <div class="card-body">
                  <h5 class="card-title">{{$book['title']}}</h5>
                  <div class="card-text">{{$book['subtitle']}}</div>
                  <div class="card-text text-danger">Price: {{$book['price']}}</div>
                  <hr>
                  <a target="_blank" href="{{$book['url']}}" class="btn btn-warning btn-block">View</a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </article>

@endsection
