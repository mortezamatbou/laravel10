@extends('notes.layout.app')

@section('title', $title)

@section("menu")
    @parent
@endsection

@section('body')
    <form method="post" action="{{ route('notes.register.handle') }}">
        @csrf
        <label>Username</label>
        <input name="username" type="text" class="form-control" value="{{ old('username') ?? '' }}" required>
        <label>Email</label>
        <input name="email" type="text" class="form-control" value="{{ old('email') ?? '' }}" required>
        <label>Password</label>
        <input name="password" type="password" class="form-control" value="" required>
        <label>Password</label>
        <input name="repassword" type="password" class="form-control" value="" required>
        <br>
        <button type="submit" class="btn btn-success">Register</button>
    </form>
@endsection
