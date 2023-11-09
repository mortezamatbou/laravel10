@extends('entities.layout.app')

@section('title', $title)

@section("menu")
    @parent
@endsection

@section('body')

    <h3>Add new Entity</h3>

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('entity.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label>First Name</label>
            <input class="form-control" type="text" name="firstName" value="{{ old('firstName') }}" required>
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input class="form-control" type="text" name="lastName" value="{{ old('lastName') }}" required>
        </div>
        <div class="form-group">
            <label>Age</label>
            <input class="form-control" type="number" min="1" max="10000" name="age" value="{{ old('age') ?? 1 }}" required>
        </div>
        <div class="form-group">
            <label>Field</label>
            <select class="form-control" name="field">
                <option value="IT" {{ old('field') == "IT" ? 'selected' : '' }}>IT</option>
                <option value="HW" {{ old('field') == "HW" ? 'selected' : '' }}>HW</option>
                <option value="SW" {{ old('field') == "SW" ? 'selected' : '' }}>SW</option>
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
        </div>
    </form>

@endsection
