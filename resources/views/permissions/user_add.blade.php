@extends('permissions.layout.app')

@section('title', $title)

@section("menu")
    @parent
@endsection

@section('body')

    <h1>Add new User</h1>
    <div class="col-12">
        <form action="{{ route('permission.user.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="text" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection
