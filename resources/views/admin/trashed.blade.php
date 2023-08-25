@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
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
                        <td class="d-flex flex-shrink-0">
                        <form class="d-inline-block me-2" action="{{ route('projects.restore', $project) }}" method="POST">
                            @csrf

                            <button type="submit" class="btn btn-success me-2">
                                Restore
                            </button>
                        </form>
                        <form action="{{ route('projects.obliterate', $project) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Obliterate</button>
                        </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $projects->links() }}
            <a href="{{ route('admin.index') }}" class="btn btn-primary">Back to dashboard</a>
        </div>
    </div>
</div>
@endsection