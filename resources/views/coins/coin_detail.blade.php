@extends('coins.layout.app')

@section('title', $title)

@section("menu")
    @parent
@endsection

@section('body')

    <h3>Detail of {{ $coin->title }}</h3>

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('coins.update', $coin->id) }}" method="post">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input class="form-control" type="text" name="title" value="{{ $coin->title }}" required>
        </div>
        <div class="form-group">
            <label>Symbol</label>
            <input class="form-control" type="text" name="symbol" value="{{ $coin->symbol }}" required>
        </div>
        <div>
            <button type="submit" class="btn btn-sm btn-success">Update</button>
        </div>
    </form>

@endsection
