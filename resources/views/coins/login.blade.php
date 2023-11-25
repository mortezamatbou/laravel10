@extends('coins.layout.app')

@section('title', $title)

@section("menu")
    @parent
@endsection

@section('body')

    <form action="{{ route('coins.login') }}" method="post">
        @csrf
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="{{ old('email') ?? 'mori@lobdown.com' }}">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="123456789mori">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-success btn-sm">
        </div>
    </form>

@endsection
