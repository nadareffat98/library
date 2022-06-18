@extends('layout')
@section('title')
CreateBook
@endsection
@section('content')
<form method="POST" action="{{route('books.store')}}">

    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="mb-3">
        <label for="desc" class="form-label">Description</label>
        <textarea class="form-control" id="desc" rows="3" name="desc"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection