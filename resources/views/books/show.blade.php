<!-- inherit layout using extends -> write path of layout  -->
@extends('layout')
@section('title')
Book
@endsection

@section('content')
<h1>{{$book->title}}:</h1>
<p class="mx-5">{{$book->desc}}</p>
<hr>
<h3>Categories:</h3>
<ul class="mx-5">
@foreach($book->categories as $category)
    <li>{{$category->name}}</li>
@endforeach
</ul>

@auth
<button class="btn btn-dark"><a href="{{route('books.index')}}" class="text-decoration-none text-white">Back</a></button>
<button class="btn btn-primary"><a href="{{route('books.edit',$book->id)}}" class="text-decoration-none text-white">Edit</a></button>
@if(Auth::user()->is_admin==1)
<button class="btn btn-danger"><a href="{{route('books.delete',$book->id)}}" class="text-decoration-none text-white">Delete</a></button>
@endif
@endauth

@endsection