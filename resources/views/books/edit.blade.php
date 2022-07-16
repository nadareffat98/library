@extends('layout')
@section('title')
EditBook - {{$book->title}}
@endsection
@section('content')

@include('inc.errors')
<form method="POST" action="{{route('books.update',$book->id)}}" enctype="multipart/form-data">

    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{old('title') ?? $book->title}}">
    </div>
    <div class="mb-3">
        <label for="desc" class="form-label">Description</label>
        <textarea class="form-control" id="desc" rows="3" name="desc">{{old('desc') ?? $book->desc}}</textarea>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">Upload Image</label>
        <input class="form-control form-control-sm" id="file" type="file" name="img">
    </div>
    Select Categories :
    @foreach($categories as $category)
    <div class="form-check mx-5">
        <input class="form-check-input" type="checkbox" value="{{$category->id}}" name="category_ids[]" id="flexCheckDefault" @foreach($book->categories as $bookCat) {{$category->id==$bookCat->id ? 'checked':''}} @endforeach>
        <label class="form-check-label" for="flexCheckDefault">
            {{$category->name}}
        </label>
    </div>
    @endforeach
    <br>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection