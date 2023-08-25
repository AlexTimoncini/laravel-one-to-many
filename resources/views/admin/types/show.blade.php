@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (count($projects) > 0)
        {{ $projects->links() }}
        @foreach ($projects as $project)
        <div class="card m-2 col-2 p-0">
            <a href="{{ $project->gitHub }}" class="text-decoration-none text-secondary">
            @if (str_starts_with($project->image, 'http'))
            <img class="card-img-top" src="{{ $project->image }}" alt="{{ $project->title }}">
            @else
            <img class="card-img-top" src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $project->title }}</h5>
                <h6 class="card-text">{{ $project->topic }}</h6>
                <p class="card-text text-secondary">{{ $project->date }}</p>
            </div>
        </a>
        </div>
        @endforeach
    </div>
    @else
    <div class="row align-items-center">
        <h1 class="col-6">There's nothing here!</h1>
        <a href="{{ route('projects.create') }}" class="btn btn-success col-4 ms-auto">Create your first project in {{ $type->name }}!</a>
    </div>
    @endif
    <a href="{{ route('admin.types.index') }}" class="btn btn-primary d-block mt-5">Back to list</a>
</div>
@endsection