@extends('layouts.master', ['title' => $product['name']])

@section('content')
  <header class="masthead" style="background-image: url({{url('main/img/home-bg.jpg')}})">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>{{$product['name']}}</h1>
          </div>
        </div>
      </div>
    </div>
  </header>

  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-7 col-md-7">

          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              @foreach($product['images'] as $image)
              <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->iteration - 1}}" class="{{$loop->iteration == 1 ? 'active' : ''}}"></li>
              @endforeach
            </ol>
            <div class="carousel-inner">
              @foreach($product['images'] as $image)
              <div class="carousel-item {{$loop->iteration == 1 ? 'active' : ''}}">
                <img class="d-block w-100" src="{{$image['image_url']}}" alt="{{$product['name']}}">
              </div>
              @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
        <div class="col-lg-5 col-md-5">
          <h2>{{$product['name']}}</h2>
          <p>{{$product['description']}}</p>
          <p>Price: € {{number_format($product['price'])}}</p>
          <p class="text-danger">Qty Left: {{$product['quantity']}}</p>
          <a href="{{url('order/' . $product['id'])}}" class="btn btn-warning">Place Order</a>
        </div>
      </div>
    </div>
  </article>
@endsection