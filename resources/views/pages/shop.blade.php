@extends('layouts.master', ['title' => 'Shop'])

@section('content')
  <!-- Page Header -->
  <header class="masthead" style="background-image: url({{url('main/img/home-bg.jpg')}})">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>NCI Social Marketplace <i class="fa fa-shopping-bag" aria-hidden="true"></i></h1>
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

          <h3 class="section-heading float-left" style="margin:20px 0">Products (0)</h3>

          <div class="float-right">
            <a href="" class="btn btn-dark">Category 1</a>
            <a href="" class="btn btn-dark">Category 2</a>
            <a href="" class="btn btn-dark">Category 3</a>
          </div>

          <div class="clearfix"></div>

          <hr>

          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="https://via.placeholder.com/100" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <div class="float-left card-text">Price: € 5.99</div>
              <div class="float-right card-text text-danger">Qty Left: 5</div>
              <div class="clearfix"></div>
              <hr>
              <a href="#" class="btn btn-warning btn-block">Add to cart</a>
            </div>
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
    </script>
@endsection