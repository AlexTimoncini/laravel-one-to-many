@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @guest
                <h1>You must be logged first!</h1>
            @else
            <a href="{{ route('projects.create') }}" class="btn btn-primary">Add a new Project</a>
            <a href="{{ route('admin.trashed') }}" class="btn btn-danger">See deleted Projects</a>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Topic</th>
                    <th scope="col">Date</th>
                    <th scope="col">Git Hub</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->topic }}</td>
                        <td>{{ $project->date }}</td>
                        <td class="text-primary">{{ $project->gitHub }}</td>
                        <td class="d-flex flex-shrink-0 pb-4">
                            <a href="{{ route('projects.show', $project) }}" class="btn btn-primary">Show</a>
                            <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning mx-2">Edit</a>
                            <form action="{{ route('projects.destroy', $project) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endguest
        </div>
    </div>
</div>
@endsection