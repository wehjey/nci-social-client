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
            <h1>{{$category}} <i class="fa fa-shopping-bag" aria-hidden="true"></i></h1>
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

          <h3 class="section-heading" style="margin:20px 0">Products ({{$total_count}})</h3>

          <hr>
          <div class="row">
            @foreach($products as $product)
            <div class="col-3">
              <div class="card" style="width: 16rem; margin-bottom: 20px">
                <img class="card-img-top" src="{{getImage($product)}}" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">{{$product['name']}}</h5>
                  <div class="float-left card-text">Price: € {{number_format($product['price'])}}</div>
                  <div class="float-right card-text text-danger">Qty Left: {{$product['quantity']}}</div>
                  <div class="clearfix"></div>
                  <hr>
                  <a href="{{url('product/' . $product['id'])}}" class="btn btn-warning">View</a>
                  <a href="{{url('order/' . $product['id'])}}" class="btn btn-dark">Order</a>
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
              window.location.href = "{{url()->current()}}?page=" + page
          }
      });
    </script>
@endsection