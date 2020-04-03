@extends('layouts.master', ['title' => 'Current Topics'])

@section('style')
    <style>
      #modalBtn {
        position: fixed;
        bottom: 50px;
        right: 50px
      }
    </style>
@endsection

@section('content')
      <!-- Page Header -->
  <header class="masthead" style="background-image: url('{{url('main/img/home-bg.jpg')}}')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>NCI Social</h1>
            <span class="subheading">Share & discuss essential topics concerning college affairs</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        @foreach($topics as $topic)
        <div class="post-preview">
          <a href="{{url('topic/' . $topic['id'])}}">
            <div class="row">
              <div class="col-2">
                <img src="{{getAuthorImage($topic)}}" class="img-thumbnail" alt="">
              </div>
              <div class="col-10">
                <h3 class="post-title" style="font-size: 1.6rem !important">
                  {{$topic['title']}}
                </h3>
                <h5 class="post-subtitle" style="font-weight: 200 !important">
                  {{$topic['description']}}
                </h5>
              </div>
            </div>
          </a>
          <p class="post-meta">Posted by
            <a href="#">{{getAuthor($topic)}}</a>
            on {{formatDate($topic['created_at'], 'd F, Y', 'Y-m-d H:i:s')}}.
            Comments: {{getTotalComments($topic)}}
          </p>
          <p>
            <div class="parent-container">
              @foreach($topic['images'] as $img)
              <a href="{{$img['image_url']}}">
                <img src="{{$img['image_url']}}" class="img-thumbnail">
              </a>
              @endforeach
            </div>
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
    </div>
  </div>


<!-- Button trigger modal -->
<button id="modalBtn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Add Discussion Topic
</button>

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
        </form>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
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
            startPage: {{$current_page}},
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
@endsection