@extends('layouts.app')

@section('content')
    <form action="/group/{{$group->id}}/settings" method="POST">
        @csrf
        nama
        <input type="text" name="name" value="{{$group->name}}">
        deskripsi
        <textarea name="description">{{$group->description}}</textarea>

        <select name="mode">
            @foreach ($mode as $m)
                <option value="{{ $m }}">{{ $m }}</option>
            @endforeach
        </select>

        <button type="submit">Ubah</button>
    </form>
@endsection