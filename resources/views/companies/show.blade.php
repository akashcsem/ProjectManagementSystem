
@extends('layouts.app')

@section('content')
<div class="row">

  <div class="col-md-9 col-lg-9 col-sm-9 pull-left">

    <!-- Jumbotron -->
    <div class="jumbotron">
      <h1>{{ $company->name }}</h1>
      <p class="lead">{{ $company->description }}</p>
    </div>

    <!-- Example row of columns -->
    <div class="row col-md-12 col-lg-12 col-sm-12 py-3" style="background: white; margin: 5px;">
      <div class="col-md-12">
        <a class="btn btn-primary btn-sm float-right" href="/projects/create/{{ $company->id }}">Add Project</a>

      </div>
      @foreach ($company->projects as $project)
        <div class="col-sm-4 col-md-4 col-lg-4">
          <h4>{{ $project->name }}</h4>
          <p> {{ $project->description }} </p>
          <p><a class="btn btn-primary" href="/projects/{{ $project->id }}" role="button">View details »</a></p>
        </div>
      @endforeach

    </div>
  </div>



  <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
    <div class="p-2" style="background: #E9ECEF">
      <h4>Action</h4>
      <ol class="list-unstyled">
        <li><a href="/companies/{{ $company->id }}/edit">Edit</a></li>
        <li><a href="/companies">Company List</a></li>
        <li><a href="/companies/create/">Create new Company</a></li>
        <li><a href="/projects/create/{{ $company->id }}">Add Project</a></li>
        <li><a data-toggle="modal" data-target="#deleteModal" href="#">Delete</a></li>
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
                <form action="{{ route('companies.destroy', [$company->id]) }}" method="post">
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
