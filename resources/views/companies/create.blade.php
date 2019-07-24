
@extends('layouts.app')

@section('content')
<div class="row">

  <div class="col-md-9 col-lg-9 col-sm-9 pull-left px-3 pt-4" style="background: #E9ECEF">

      <h3>Create New Company</h3>
      <form class="w-100" method="post" action="{{ route('companies.store') }}">
        @csrf
        {{-- <input type="hidden" name="_method" value="put"> --}}

        <div class="form-group">
          <label for="company-name">Company Name <span class="required">*</span> </label>
          <input type="text" name="name" value="" placeholder="Enter Company Name" class="form-control" id="email">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea name="description" class="form-control float-left" id="description" rows="3" placeholder="Write something about your company" cols="80">

          </textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-sm my-2">Create</button>
      </form>

  </div>



  <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
    <div class="p-2" style="background: #E9ECEF">
      <h4>Action</h4>
      <ol class="list-unstyled">
        <li><a href="/companies/">View Company</a></li>
        <li><a href="/companies">All Company</a></li>
      </ol>
    </div>
  </div>

</div>

@endsection
