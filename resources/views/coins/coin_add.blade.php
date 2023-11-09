@extends('coins.layout.app')

@section('title', $title)

@section("menu")
    @parent
@endsection

@section('body')

    <h3>Add new coin</h3>

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('coins.add') }}" method="post">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input class="form-control" type="text" name="title" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label>Symbol</label>
            <input class="form-control" type="text" name="symbol" value="{{ old('symbol') }}">
        </div>
        <div>
            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
        </div>
    </form>

@endsection
