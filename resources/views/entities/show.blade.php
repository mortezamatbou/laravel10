@extends('entities.layout.app')

@section('title', $title)

@section("menu")
    @parent
@endsection

@section('body')

    <h3>Detail of {{ $entity->firstName . ' ' . $entity->lastName }}</h3>

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('entity.update', $entity->id) }}" method="post">
        @csrf
        <div class="form-group">
            <label>First Name</label>
            <input class="form-control" type="text" name="firstName" value="{{ $entity->firstName }}" required>
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input class="form-control" type="text" name="lastName" value="{{ $entity->lastName }}" required>
        </div>
        <div class="form-group">
            <label>Age</label>
            <input class="form-control" type="number" min="1" max="100" name="age" value="{{ $entity->age }}" required>
        </div>
        <div class="form-group">
            <label>Field</label>
            <select class="form-control" name="field">
                <option value="IT" {{ $entity->field == "IT" ? 'selected' : '' }}>IT</option>
                <option value="HW" {{ $entity->field == "HW" ? 'selected' : '' }}>HW</option>
                <option value="SW" {{ $entity->field == "SW" ? 'selected' : '' }}>SW</option>
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-sm btn-success">Update</button>
        </div>
    </form>

@endsection
