@extends('layout')
@section('title')
EditBook - {{$book->title}}
@endsection
@section('content')
<form method="POST" action="{{route('books.update',$book->id)}}">

    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{$book->title}}">
    </div>
    <div class="mb-3">
        <label for="desc" class="form-label">Description</label>
        <textarea class="form-control" id="desc" rows="3" name="desc" >{{$book->desc}}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection