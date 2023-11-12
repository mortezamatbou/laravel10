@extends('permissions.layout.app')

@section('title', $title)

@section("menu")
    @parent
@endsection

@section('body')

    <h1>List of Roles</h1>

    <div class="col-12 border p-4">
        <h3>Add new Role</h3>
        <form>
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name" type="text" required>
            </div>
            <div class="form-group">
                <label>Guard</label>
                <input class="form-control" name="guard" type="text" value="web" disabled>
            </div>
            <div class="form-group">
                <button class="btn btn-sm btn-success">Submit</button>
            </div>
        </form>
    </div>

    <hr>

    <table class="table table-hover text-center border">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Guard name</td>
            <td>&nbsp;</td>
        </tr>
        @foreach($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->guard_name }}</td>
                <td><a class="btn btn-sm btn-success" href="">Detail</a></td>
            </tr>
        @endforeach
    </table>
@endsection
