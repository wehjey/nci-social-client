@extends('layouts.master', ['title' => 'My Topics'])

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
                <a class="nav-link active" id="topics-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">My Topics</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="products-tab" data-toggle="tab" href="#product" role="tab" aria-controls="product" aria-selected="false">My Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="orders-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">My Orders</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
              <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                @include('shared.alerts')
                  <!-- Button trigger modal -->
                  <button id="modalBtn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Add Discussion Topic
                  </button>
                @foreach($topics as $topic)
                <div class="post-preview">
                  <a href="{{url('topic/' . $topic['id'])}}">
                    <h2 class="post-title">
                      {{$topic['title']}}  
                    </h2>
                    <h3 class="post-subtitle">
                      {{$topic['description']}}
                    </h3>
                  </a>
                  <p>
                    <div class="parent-container">
                      @foreach($topic['images'] as $img)
                      <a href="{{$img['image_url']}}">
                        <img src="{{$img['image_url']}}" class="img-thumbnail" width="200">
                      </a>
                      @endforeach
                    </div>
                    <a href="{{url('delete-topic/' . $topic['id'])}}" class="badge badge-danger text-white">Delete</a>
                  </p>
                </div>
                <hr>
                @endforeach
                <!-- Pager -->
                <div class="clearfix">
                  {{-- <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a> --}}
                  <nav id="pagination" class="pagination"></nav>
                </div>
              </div>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Discussion Topic</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="error" class="alert alert-danger d-none" role="alert">
              Please fill in all required fields
          </div>
        <form id="form" action="{{url('topic')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="title">Title <i class="text-danger">*</i></label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
          </div>
          <div class="form-group">
            <label for="description">Description <i class="text-danger">*</i></label>
            <textarea type="text" class="form-control" rows="5" id="description" name="description" placeholder="Enter description" required></textarea>
          </div>
          <div class="form-group">
            <label for="file">Add Images</label>
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
    <script>
        $('#pagination').twbsPagination({
            totalPages: {{$total_pages}},
            startPage: {{$total_pages > 0 ? $current_page : 0}},
            visiblePages: 7,
            onPageClick: function (event, page) {
                window.location.href = "{{url()->current()}}?page=" + page
            }
        });

        $('.parent-container').magnificPopup({
          delegate: 'a', // child items selector, by clicking on it popup will open
          type: 'image'
          // other options
        });

        // $('body').on('click', '#submit', function(){
        //   if(validateForm()) {
        //     $('#form').submit();
        //   } else {
        //     $('#error').toggleClass('d-none')
        //   }
        // })

        // function validateForm() {
        //   if ($('#title').val() == '' || $('#description').val() == '') {
        //     return false;
        //   }
        //   return true;
        // }
    </script>
    @include('shared.nav_script')
@endsection