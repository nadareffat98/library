@extends('layout')
@section('title')
CreateNote
@endsection
@section('content')

@include('inc.errors')

<form method="POST" action="{{route('notes.store')}}">

    @csrf
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" rows="3" name="content">{{old('content')}}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection