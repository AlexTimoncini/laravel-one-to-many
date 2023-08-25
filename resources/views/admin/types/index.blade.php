@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Color</th>
                    <th scope="col">Documentation</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($types as $type)
                    <tr>
                        <th scope="row">{{ $type->id }}</th>
                        <td>{{ $type->name }}</td>
                        <td style="color: {{$type->color}};">{{ $type->color }}</td>
                        <td class="text-primary">{{ $type->documentation }}</td>
                        <td class="d-flex flex-shrink-0 pb-4">
                            <a href="{{ route('admin.types.show', $type) }}" class="btn btn-primary flex-grow-1">Show {{ $type->name }} Projects</a>
                            <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-warning mx-2">Edit</a>
                            <form action="{{ route('admin.types.destroy', $type) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $types->links() }}

            <a href="{{ route('admin.index') }}" class="btn btn-primary">Back to Dashboard</a>
        </div>
    </div>
</div>
@endsection