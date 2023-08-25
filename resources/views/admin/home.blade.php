@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <h1>
                Welcome Back, {{ Auth::user()->name }}
            </h1>
        </div>
        <div class="col-4" id="dashboard_actions" class="my-4">
            <h2 class="text-center">ACTIONS</h2>
            <h3>Projects</h3>
            <a href="{{ route('projects.index') }}" class="btn btn-primary d-block mt-2">See Project List</a>
            <a href="{{ route('projects.create') }}" class="btn btn-success d-block mt-2">Add a new Project</a>
            <a href="{{ route('admin.trashed') }}" class="btn btn-danger d-block mt-2">See deleted Projects</a>

            <h3 class="mt-4">Types</h3>
            <a href="{{ route('admin.types.index') }}" class="btn btn-primary d-block mt-2">See Types List</a>
            <a href="{{ route('admin.types.create') }}" class="btn btn-success d-block mt-2">Add a new Type</a>
        </div>
    </div>
</div>
@endsection