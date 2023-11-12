@extends('permissions.layout.app')

@section('title', $title)

@section("menu")
    @parent
@endsection

@section('body')

    <h1>List of Users</h1>
    <table class="table table-hover text-center border">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>Email verified at</td>
            <td>password</td>
            <td>Remember token</td>
            <td>Created at</td>
            <td>Update at</td>
            <td>&nbsp;</td>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->email_verified_at }}</td>
                <td>{{ $user->password }}</td>
                <td>{{ $user->remember_token }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
                <td><a class="btn btn-sm btn-success" href="">Detail</a></td>
            </tr>
        @endforeach
    </table>
@endsection
