@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card w-50 mx-auto">
                @if (str_starts_with($project->image, 'http'))
                <img class="card-img-top" src="{{ $project->image }}" alt="{{ $project->title }}">
                @else
                <img class="card-img-top" src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $project->title }}</h5>
                    <h6 class="card-title ivy_card_type" style="color: {{ $project->type->color }};">{{ $project->type->name }}</h6>
                    <h6 class="card-text">{{ $project->topic }}</h6>
                    <p class="card-text text-secondary">{{ $project->date }}</p>
                    <p class="card-text">{{ $project->gitHub }}</p>
                    <a href="{{ route('projects.index') }}" class="btn btn-primary">Back to list</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection