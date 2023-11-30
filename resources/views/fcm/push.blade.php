@extends('fcm.layout.app')

@section('title', $title)

@section("menu")
    @parent
@endsection

@section('body')

    <h3>Push Notification in FCM channel</h3>

    <form action="{{ route('fcm.push') }}" method="post">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input class="form-control" type="text" name="title" required>
        </div>
        <div class="form-group">
            <label>Body</label>
            <textarea rows="7" class="form-control" name="body" required></textarea>
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Push">
        </div>
    </form>

@endsection
