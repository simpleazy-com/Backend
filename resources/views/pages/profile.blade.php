@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card" style="width: 18rem;">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Nama : {{ $data -> name }} </li>
        <li class="list-group-item">Email : {{ $data -> email }} </li>
        <li class="list-group-item"><button class="btn btn-primary">Edit</button></li>
    </ul>
    </div>
</div>
@endsection