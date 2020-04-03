@extends('layouts.master', ['title' => 'Shop'])

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
            <h1>Search Book <i class="fa fa-book" aria-hidden="true"></i></h1>
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

        <h3 class="section-heading float-left" style="margin:20px 0">Books - {{request('keyword')}}</h3>
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

          <div class="clearfix">
            {{-- <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a> --}}
            <nav id="pagination" class="pagination"></nav>
          </div>
        </div>
      </div>
    </div>
  </article>

@endsection

@section('script')
    <script>
      $('.parent-container').magnificPopup({
        delegate: 'a', // child items selector, by clicking on it popup will open
        type: 'image'
        // other options
      });

      $('#pagination').twbsPagination({
          totalPages: {{$total_pages}},
          startPage: {{$current_page}},
          visiblePages: 7,
          onPageClick: function (event, page) {
              window.location.href = "{{url()->current()}}?keyword={{request('keyword')}}&page=" + page
          }
      });
    </script>
@endsection