
@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-8 col-lg-8 mx-auto">

      <div class="card">
        <div class="card-heading p-2 bg-secondary">
          <h3 class="d-block text-light">Companies
            <a href="/companies/create/" class="float-right btn btn-sm btn-primary" name="button">Add New</a>
          </h3>
        </div>
        <div class="card-body">
          <ul class="list-group">
            @foreach ($companies as $company)
              <li class="list-group-item"><a href="/companies/{{ $company->id }}">{{ $company->name }}</a> </li>
            @endforeach
          </ul>
        </div>
      </div>

    </div>
  </div>

@endsection
