@extends('layout')
@section('title')
Category
@endsection

@section('content')
<h1>Category ID : {{$category->id}}</h1>
<p class="mx-5">{{$category->name}}</p>
<hr>
<h3>Books:</h3>
<ul class="mx-5">
@foreach($category->books as $book)
    <li>{{$book->title}}</li>
@endforeach
</ul>

<button class="btn btn-dark"><a href="{{route('categories.index')}}" class="text-decoration-none text-white">Back</a></button>
<button class="btn btn-primary"><a href="{{route('categories.edit',$category->id)}}" class="text-decoration-none text-white">Edit</a></button>
<button class="btn btn-danger"><a href="{{route('categories.delete',$category->id)}}" class="text-decoration-none text-white">Delete</a></button>

@endsection