@extends('layouts.app')

@section('content')
    @foreach($users as $user)
        <form action="/group/{{ Request::route('id') }}/pending" method="POST">
            @csrf
            {{ $user->name }}
            <input type="hidden" name="user_id" value="{{ $user->user_id }}">
            <button type="submit" value="accepted" name="status">Accept</button>
            <button type="submit" value="rejected" name="status">Reject</button>
        </form>
    @endforeach
@endsection