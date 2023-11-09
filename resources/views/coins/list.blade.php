@extends('coins.layout.app')

@section('title', $title)

@section("menu")
    @parent
@endsection

@section('body')

    <table class="table table-hover text-center border">
        <tr>
            <td>ID</td>
            <td>Title</td>
            <td>Symbol</td>
            <td>&nbsp;</td>
        </tr>
        @foreach($coins as $coin)
            <tr>
                <td>{{ $coin->id }}</td>
                <td>{{ $coin->title }}</td>
                <td>{{ $coin->symbol }}</td>
                <td><a href="{{ route('coins.detail', $coin->id) }}" class="btn btn-sm btn-success">Detail</a></td>
            </tr>
        @endforeach
    </table>

@endsection
