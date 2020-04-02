@extends('layouts.master', ['title' => 'My Orders'])

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
                <a class="nav-link" id="details-tab" data-toggle="tab" href="{{url('my')}}" role="tab" aria-controls="home" aria-selected="true">My Details</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="topics-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">My Topics</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="products-tab" data-toggle="tab" href="#product" role="tab" aria-controls="product" aria-selected="false">My Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" id="orders-tab" data-toggle="tab" href="#order" role="tab" aria-controls="contact" aria-selected="false">My Orders</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
              <div class="tab-pane fade show active" id="order" role="tabpanel" aria-labelledby="orders-tab">
                <br>

                @include('shared.alerts')

                <div id="accordion">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                          My Orders
                        </button>
                      </h5>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                      <div class="card-body">
                        <table id="table" class="table table-striped" style="font-size:15px">
                          <thead>
                            <th>S/N</th>
                            <th>Seller</th>
                            <th>Phone</th>
                            <th>Product</th>
                            <th>Reference</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Status</th>
                          </thead>
                          <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                  <td>{{$loop->iteration}}</td>
                                  <td>{{ucwords($order['user']['firstname'] . ' ' . $order['user']['lastname'])}}</td>
                                  <td>{{$order['user']['phone_number']}}</td>
                                  <td>{{$order['product']['name']}}</td>
                                  <td>{{$order['reference']}}</td>
                                  <td>{{$order['quantity']}}</td>
                                  <td>{{$order['price']}}</td>
                                  <td>{{formatDate($order['created_at'], 'd F, Y', 'Y-m-d H:i:s')}}</td>
                                  <td>{{ucwords($order['status'])}}</td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          My Sales
                        </button>
                      </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                        <table id="table" class="table table-striped" style="font-size:15px">
                          <thead>
                            <th>S/N</th>
                            <th>Buyer</th>
                            <th>Phone</th>
                            <th>Product</th>
                            <th>Reference</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Status</th>
                          </thead>
                          <tbody>
                            @foreach ($sales as $order)
                                <tr>
                                  <td>{{$loop->iteration}}</td>
                                  <td>{{ucwords($order['buyer']['firstname'] . ' ' . $order['buyer']['lastname'])}}</td>
                                  <td>{{$order['buyer']['phone_number']}}</td>
                                  <td>{{$order['product']['name']}}</td>
                                  <td>{{$order['reference']}}</td>
                                  <td>{{$order['quantity']}}</td>
                                  <td>{{$order['price']}}</td>
                                  <td>{{formatDate($order['created_at'], 'd F, Y', 'Y-m-d H:i:s')}}</td>
                                  <td>{{ucwords($order['status'])}}</td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </article>

@endsection

@section('script')
    @include('shared.nav_script')
    <script>
      $(document).ready(function() {
          $('.table').DataTable();
      } );
    </script>
@endsection
