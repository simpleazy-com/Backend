@extends('layouts.app')

@section('content')

    <form action="/group/{{Request::route('id')}}/payment/add" method="POST">
        @csrf
        <input type="number" name="nominal">

        @foreach ($memberList as $ml)
            <input type="checkbox" name="selected_member[]" value="{{ $ml->id }}"> {{ $ml->name }}
        @endforeach
        
        <button type="submit">Buat</button>
    </form>
    
@endsection