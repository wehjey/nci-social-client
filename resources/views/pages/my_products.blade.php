@extends('layouts.master', ['title' => 'My Products'])

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
                <a class="nav-link active" id="products-tab" data-toggle="tab" href="#product" role="tab" aria-controls="product" aria-selected="false">My Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="orders-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">My Orders</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
              <div class="tab-pane fade show active" id="product" role="tabpanel" aria-labelledby="product-tab">
                @include('shared.alerts')
                <button id="modalBtn" type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                  Add New Product
                </button>
                <table id="table" class="table table-striped">
                  <thead>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    @foreach ($products as $product)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$product['name']}}</td>
                          <td>{{$product['description']}}</td>
                          <td>{{$product['category']['name']}}</td>
                          <td>{{$product['quantity']}}</td>
                          <td>{{$product['price']}}</td>
                          <td>
                            @if(!$product['transactions_count'])
                            <button id="modalBtn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$loop->iteration}}">
                              Edit
                            </button>
                            <a href="{{url('delete-product/'.$product['id'])}}" class="btn btn-danger text-white">Delete</a>
                            <div class="modal fade" id="exampleModal{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div id="error" class="alert alert-danger d-none" role="alert">
                                          Please fill in all required fields
                                      </div>
                                    <form id="form" action="{{url('product/edit')}}" method="post" enctype="multipart/form-data">
                                      @csrf
                                      <input type="hidden" name="product_id" value="{{$product['id']}}">
                                      <div class="form-group">
                                        <label for="title">Category <i class="text-danger">*</i></label>
                                        <select name="category_id" id="cat" class="form-control" required>
                                          <option value="">Select category</option>
                                          @foreach ($categories as $cat)
                                              <option value="{{$cat['id']}}" {{$product['category_id'] == $cat['id'] ? 'selected' : ''}}>{{$cat['name']}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <label for="title">Name <i class="text-danger">*</i></label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{$product['name']}}" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="description">Description <i class="text-danger">*</i></label>
                                        <textarea type="text" class="form-control" rows="5" id="description" name="description" placeholder="Enter description" required>{{$product['description']}}</textarea>
                                      </div>
                                      <div class="form-group">
                                        <label for="title">Quantity <i class="text-danger">*</i></label>
                                        <input type="number" class="form-control" id="name" name="quantity" placeholder="Enter quantity" value="{{$product['quantity']}}" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="title">Price <i class="text-danger">*</i></label>
                                        <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" value="{{$product['price']}}" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="file">Add Images <i class="text-danger">*</i></label>
                                        <input type="file" class="form-control" id="file" name="images[]" multiple>
                                      </div>
                                      <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @endif
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
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
        <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="error" class="alert alert-danger d-none" role="alert">
              Please fill in all required fields
          </div>
        <form id="form" action="{{url('product')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="title">Category <i class="text-danger">*</i></label>
            <select name="category_id" id="cat" class="form-control" required>
              <option value="">Select category</option>
              @foreach ($categories as $cat)
                  <option value="{{$cat['id']}}">{{$cat['name']}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="title">Name <i class="text-danger">*</i></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
          </div>
          <div class="form-group">
            <label for="description">Description <i class="text-danger">*</i></label>
            <textarea type="text" class="form-control" rows="5" id="description" name="description" placeholder="Enter description" required></textarea>
          </div>
          <div class="form-group">
            <label for="title">Quantity <i class="text-danger">*</i></label>
            <input type="number" class="form-control" id="name" name="quantity" placeholder="Enter quantity" required>
          </div>
          <div class="form-group">
            <label for="title">Price <i class="text-danger">*</i></label>
            <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" required>
          </div>
          <div class="form-group">
            <label for="file">Add Images <i class="text-danger">*</i></label>
            <input type="file" class="form-control" id="file" name="images[]" multiple>
          </div>
          <button type="submit" id="submit" class="btn btn-primary">Submit</button>
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
    <script>
      $(document).ready(function() {
          $('#table').DataTable();
      } );
    </script>
@endsection
