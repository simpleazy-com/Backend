@extends('layouts.app')

@section('content')
    @foreach ($users as $user)
        <form action="/group/{{Request::route('id')}}/adminship/add" method="POST">
            @csrf
            {{ $user->name }}
            <input type="hidden" name="user_id" value="{{ $user->user_id }}">
            <select name="role" id="">
                @foreach ($roles as $role)
                    <option value="admin">Admin</option>
                @endforeach
            </select>
            <button type="submit">Change Role</button>
        </form>
    @endforeach
@endsection