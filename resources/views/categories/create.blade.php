@extends('layout')
@section('title')
CreateCategory
@endsection
@section('content')

@include('inc.errors')
<form method="POST" action="{{route('categories.store')}}">

    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{old('title')}}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection