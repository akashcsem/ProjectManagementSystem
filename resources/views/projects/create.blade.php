
@extends('layouts.app')

@section('content')
<div class="row">

  <div class="col-md-9 col-lg-9 col-sm-9 pull-left px-3 pt-4" style="background: #E9ECEF">


    <h3>Create New Project</h3>
      <form class="w-100" method="post" action="{{ route('companies.store') }}">
        @csrf
        <div class="form-group">
          <label for="project-name">Project Name <span class="required">*</span> </label>
          <input type="text" name="name" value="" placeholder="Enter Project Name" class="form-control" id="email">
        </div>



        @if ($companies != null)
          <div class="form-group">
            <label for="company-name">Select Company <span class="required">*</span> </label>
            <select class="form-control" name="company_id">
              @foreach ($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
              @endforeach
            </select>
          </div>
        @else
          <input type="hidden" name="company_id" value="{{ $company_id }}">
        @endif

        <div class="form-group">
          <label for="description">Description</label>
          <textarea name="description" class="form-control float-left" id="description" rows="3" placeholder="Write something about your project" cols="80">

          </textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-sm my-2">Create</button>
      </form>

  </div>



  <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
    <div class="p-2" style="background: #E9ECEF">
      <h4>Action</h4>
      <ol class="list-unstyled">
        <li><a href="/companies/">View Project</a></li>
        <li><a href="/companies">All Project</a></li>
      </ol>
    </div>
  </div>

</div>

@endsection
