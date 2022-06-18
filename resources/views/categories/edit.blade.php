@extends('layout')
@section('title')
EditCategory - {{$category->title}}
@endsection
@section('content')

@include('inc.errors')
<form method="POST" action="{{route('categories.update',$category->id)}}">

    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{old('name') ?? $category->name}}">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection