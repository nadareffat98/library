@extends('layout')
@section('title')
Categories
@endsection
@section('content')
<button class="btn btn-success offset-5 mt-3"><a href="{{route('categories.create')}}" class="text-decoration-none text-white">Create</a></button>
<h1>All Categories</h1>
@foreach($categories as $category)

<hr>
<a href="{{route('categories.show',$category->id)}}"><h2>{{$category->name}}</h2></a>
@endforeach

<!-- render->show paginate buttons -->

{{$categories->render()}}

@endsection