@extends('layouts.app')

@section('content')
    <form action="/group/create" method="POST">
        @csrf
        Nama Group
        <input type="text" name="name">
        Deskripsi
        <textarea name="description" cols="30" rows="10"></textarea>
        <select name="mode">
            @foreach ($mode as $m)
                <option value="{{ $m }}">{{ $m }}</option>
            @endforeach
        </select>
        <button type="submit">Buat</button>
    </form>
@endsection