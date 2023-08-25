@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control" placeholder="Title" name="title" value="{{ old('title', '') }}">
                    </div>
                    <select class="col-6 rounded text-secondary bg-transparent" name="type">
                        <option selected>Choose the argument of your project</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" >{{ $type->name }}</option>
                        @endforeach
                    </select>
                    <div class="col-12 mt-3">
                        <input type="text" class="form-control" placeholder="Detailed Argument" name="topic" value="{{ old('topic', '') }}">
                    </div>
                    <div class="col-12 input-group my-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">https://github</span>
                        </div>
                        <input type="text" class="form-control" name="gitHub" value="{{ old('gitHub', '') }}">
                    </div>
                    <div class="col-8 mx-auto">
                        <input type="file" name="image" id="image" class="form-control" placeholder="Upload your image" value="{{ old('image', '') }}">
                    </div>
                    <div class="col-7 mx-auto">
                        <button type="submit" class="btn btn-primary d-block w-100 mt-2 mb-5">Save</button>
                    </div>
                </div>
            </form>
            <a href="{{ route('admin.index') }}" class="btn btn-primary mt-6 d-block">Back to dashboard</a>
        </div>
    </div>
</div>
@endsection