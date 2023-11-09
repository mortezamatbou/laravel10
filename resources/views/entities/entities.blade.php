@extends('entities.layout.app')

@section('title', $title)

@section("menu")
    @parent
@endsection

@section('body')

    <table class="table table-hover text-center border">
        <tr>
            <td>ID</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Age</td>
            <td>Field</td>
            <td>&nbsp;</td>
        </tr>
        @foreach($entities as $person)
            <tr>
                <td>{{ $person->id }}</td>
                <td>{{ $person->firstName }}</td>
                <td>{{ $person->lastName }}</td>
                <td>{{ $person->age }}</td>
                <td>{{ $person->field }}</td>
                <td><a href="{{ route('entity.detail', $person->id) }}" class="btn btn-sm btn-success">Detail</a></td>
            </tr>
        @endforeach
    </table>

@endsection
