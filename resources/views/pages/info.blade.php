@extends('layouts.app')
@section('content')
<div class="konten group-detail-info">
    
    <h1>{{ $data['group'][0] -> name }}</h1>
    <h4>Code : {{ $data['group'][0] -> code }}</h4>
    <h5>Group Created : {{ date('d-M-Y', strtotime($data['group'][0] -> created_at)) }}</h5>
    <h5>Group Owner : {{ $data['owner'][0] -> name}}</h5>
    @if(Auth::id() != $data['owner'][0] -> user_id)
        @if(sizeof($data['isAdmin']) != 1)
            <form action="/group/leave" method="post">
            @csrf
                <input type="hidden" name="isAdmin" value="false">
                <input type="hidden" name="group_id" value="{{ $data['group'][0] -> id }}">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <button type="submit" class="btn btn-danger">Keluar Dari Group</button>
            </form>
        @else
            <form action="/group/leave" method="post">
            @csrf
                <input type="hidden" name="isAdmin" value="true">
                <input type="hidden" name="group_id" value="{{ $data['group'][0] -> id }}">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <button type="submit" class="btn btn-danger">Keluar Dari Group</button>
            </form>
        @endif
    @endif
</div>
@endsection