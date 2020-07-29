@extends('layouts.app')

@section('content')
    <form action="/group/join" method="POST">
        @csrf
        Code
        <input type="text" name="code">
        <button type="submit">Gabung</button>
    </form>
@endsection