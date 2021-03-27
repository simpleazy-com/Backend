@extends('layouts.app')
@section('content')
<div class="konten group-detail-info">
    <h1>{{ $data['group'][0] -> name }}</h1>
    <h4>Code : {{ $data['group'][0] -> code }}</h4>
    <h5>Group Created : {{ date('d-M-Y', strtotime($data['group'][0] -> created_at)) }}</h5>
    <h5>Group Owner : {{ $data['owner'][0] -> name}}</h5>
</div>
@endsection