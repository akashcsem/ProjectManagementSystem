
@extends('layouts.app')

@section('content')
<div class="row">

  <div class="col-md-9 col-lg-9 col-sm-9 pull-left">

    <!-- Jumbotron -->
    <div class="well well-lg p-2" style="background: #E9ECEF">
      <h3>{{ $project->name }}</h3>
      <p class="lead">{{ $project->description }}</p>
    </div>

    <!-- Example row of columns -->
    <div class="row col-md-12 col-lg-12 col-sm-12 py-3" style="background: white; margin: 5px;">
      <div class="col-md-12">
        <a class="btn btn-primary btn-sm float-right" href="/projects/create/">Add Project</a>

      </div>


      <form class="w-100" method="post" action="{{ route('comments.store') }}">
        @csrf

        <input type="hidden" name="commentable_type" value="App\Project">
        <input type="hidden" name="commentable_id" value="{{ $project->id }}">

        <div class="form-group">
          <label for="comment">Comment</label>
          <textarea name="body" class="form-control float-left" id="comment" rows="5" placeholder="Write a comment" cols="80">
          </textarea>
        </div>

        <div class="form-group">
          <label for="comment-url">Url/Screenshort</label>
          <textarea type="text" name="url"  rows="3" placeholder="Enter URL" class="form-control" id="comment-url"></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-sm my-2">Create</button>
      </form>

      <div class="row">
        <!-- Fluid width widget -->
         <div class="panel panel-default">
               <div class="panel-heading">
                   <h3 class="panel-title">
                       <span class="glyphicon glyphicon-comment"></span> 
                       Recent Comments
                   </h3>
               </div>
               <div class="panel-body">
                   <ul class="media-list">
                     @foreach ($project->comments as $comment)
                       <li class="media">
                           <div class="media-left">
                               <img src="https://www.w3schools.com/images/lamp.jpg" class="img-circle">
                           </div>
                           <div class="media-body">
                               <h5 class="">
                                   {{ $comment->user->name }}
                                   <br>
                                   <small>
                                       {{ $comment->created_at->format('d, M Y') }}
                                       {{ $comment->created_at->format('H:i') }}
                                   </small>
                               </h5>
                               <p>{{ $comment->body }}</p>
                               <p>{{ $comment->url }}</p>
                           </div>
                       </li>
                     @endforeach
                   </ul>
                   <a href="#" class="btn btn-default btn-block">More Events »</a>
               </div>
           </div>
      </div>


    </div>
  </div>



  <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
    <div class="p-2" style="background: #F8FAFC">
      <h4>Action</h4>
      <ol class="list-unstyled">
        {{-- <li><a href="/companies/{{ $company->id }}/edit">Edit</a></li> --}}
        <li><a href="/projects/{{ $project->id }}/edit">Edit</a></li>
        <li><a href="/projects/create/">Create new Project</a></li>
        <li><a href="/projects">My Project</a></li>
        @if ($project->user_id == Auth::user()->id)
        <li><a data-toggle="modal" data-target="#deleteModal" href="#">Delete</a></li>
        @endif
      </ol>

      <hr>
      <h4>Action</h4>
      <form method="post" action="{{ route('projects.adduser') }}">
        <input type="hidden" name="project_id" value="{{ $project->id }}">
        @csrf
        <div class="input-group mb-3">
          <input name="email" type="text" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <button type="submit" class="btn btn-default">Add</button>
          </div>
        </div>
      </form>

      <hr>
      <h4>Team Members</h4>
      <ol class="list-unstyled">
        @foreach ($project->users as $user)
          <li><a href="#">{{ $user->email }}</a></li>
        @endforeach

      </ol>

      <!-- Delete Modal -->
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h5 class="modal-title text-light">Delete Company</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            {{-- </div>
            <div class="modal-body"> --}}
            </div>
            <div class="modal-body text-light">
              Are you confirm to delete the company?
              <div class="pt-3">
                <form action="{{ route('projects.destroy', [$project->id]) }}" method="post">
                  @csrf
                  <input style="display: none" type="hidden" name="_method" value="delete">
                  <button type="submit" class="btn btn-primary btn-sm float-right">Delete</button>
                </form>
                <button type="button" class="btn btn-warning mr-2 btn-sm float-right" data-dismiss="modal">Cancel</button>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>

@endsection
