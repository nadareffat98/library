@extends('layout')
@section('title')
Books
@endsection
@section('content')
@auth
<button class="btn btn-success offset-5 mt-3"><a href="{{route('books.create')}}" class="text-decoration-none text-white">Create</a></button>
<h3>Notes:</h3>
<ul>
    @foreach(Auth::user()->notes as $note)
    <li class="mx-4">
        {{$note->content}}
    </li>
    @endforeach
</ul>
<a class="btn btn-success mx-4" href="{{route('notes.create')}}">Add New Note</a>
@endauth
<h1>All Books</h1>
@foreach($books as $book)

<hr>

<a href="{{route('books.show',$book->id)}}">
    <h2>{{$book->title}}</h2>
</a>
<p>{{$book->desc}}</p>
@endforeach

<!-- render->show paginate buttons -->

{{$books->render()}}

@endsection