@extends('layout')
@section('title')
CreateBook
@endsection
@section('content')

@include('inc.errors')
<form method="POST" action="{{route('books.store')}}" enctype="multipart/form-data">

    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
    </div>
    <div class="mb-3">
        <label for="desc" class="form-label">Description</label>
        <textarea class="form-control" id="desc" rows="3" name="desc">{{old('desc')}}</textarea>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">Upload Image</label>
        <input class="form-control form-control-sm" id="file" type="file" name="img">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection