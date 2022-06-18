@extends('layout')
@section('title')
Books
@endsection
@section('content')
<h1>All Books</h1>
@foreach($books as $book)

<hr>
<a href="{{route('books.show',$book->id)}}"><h2>{{$book->title}}</h2></a>
<p>{{$book->desc}}</p>
@endforeach

<!-- render->show paginate buttons -->

{{$books->render()}}

@endsection