@extends('layouts.app')

@section('content')

    <form action="/group/{{Request::route('id')}}/payment/add" method="POST">
        @csrf
        <input type="number" name="nominal">
        <button type="submit">Buat</button>
    </form>
    
@endsection