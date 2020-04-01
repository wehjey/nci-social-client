@extends('layouts.master', ['title' => $topic['title']])

@section('content')
  <!-- Page Header -->
  <header class="masthead" style="background-image: url({{url('main/img/home-bg.jpg')}})">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>{{$topic['title']}}</h1>
            <span class="meta">Posted by
              <a href="#">{{getAuthor($topic)}}</a>
              on {{formatDate($topic['created_at'], 'd F, Y', 'Y-m-d H:i:s')}}.
            Comments: {{getTotalComments($topic)}}</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <p>
            {{$topic['description']}}
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

          <h2 class="section-heading">Comments ({{getTotalComments($topic)}})</h2>

          @if(getTotalComments($topic))
          <div id="comments"></div>
          @else
          <div class="alert alert-warning" role="alert">
              No comments for this post.
          </div>
          @endif

          <div style="padding: 10px; border-radius: 8px; background-color: #f2f2f2">
            @include('shared.alerts')
              <span>Add Comment</span>
              <form name="sentMessage" action="{{url('comment')}}" method="POST" enctype="multipart/form-data" id="contactForm">
                @csrf
                <input type="hidden" name="topic" value="{{$topic['id']}}">
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls">
                    <label>Comment</label>
                    <input type="text" class="form-control" name="comment" placeholder="Comment" id="name" required>
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls">
                    <label>Upload image</label>
                    <input type="file" class="form-control" multiple id="email" name="images[]">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <br>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary" id="sendMessageButton">Send</button>
                </div>
              </form>
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

      $(document).ready(function(){
        
        const url = "http://{{config('app.api_url')}}/comments/topic/{{$topic['id']}}";

        var headers = new Headers();
        headers.append('authorization', "Bearer {{session('token')}}");
        headers.append('Access-Control-Allow-Origin', '*');

        let list = '';

        fetch(url, {
          method: 'GET',
          headers: headers
        })
        .then((resp) => resp.json())
        .then(function(resp) {
            if(resp.success) {
              let comments = resp.data.data
              comments.forEach(function(comment, index){
                let images = '';

                comment.images.forEach(function(image){
                  images += '<img src="'+image.image_url+'" style="margin-right: 5px" class="img-thumbnail">'
                })


                list += '<div>' +
                        '<p style="margin: 5px 0;"><span style="text-transform:capitalize;">' + comment.user.firstname + ' ' + comment.user.lastname + '</span> says, ' +comment.description + removeLink(comment.user_id, comment.id) + '</p>' +
                        '<p style="margin: 5px 0;">' + images + '</p>' +
                        '</div>' +
                        '<hr>'
              });

              $('#comments').append(list)
            }
        })
        .catch(function() {
            // This is where you run code if the server returns any errors
        });

        function removeLink(user_id,comment_id) {
          let id = {{session('user')['id']}};
          if(id == user_id) {
            return ' <a href="{{url("comment-remove")}}/' + comment_id + '" class="badge badge-danger">remove</a>';
          } else {
            return '';
          }
        }


      })
    </script>
@endsection