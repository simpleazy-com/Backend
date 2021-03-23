@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card" style="width: 18rem;">
        <div><span>Your Name :</span> {{ $data -> name }} </div>
        
        <div><span>Your Email :</span> {{ $data -> email }} </div>
    <style>
        body{
            font-family: consolas;
        }
        .card{
            background: purple;
            color: white;
            text-align: center;
            padding: 30px;
            margin: 5px;
            border-bottom: 8px solid indigo;
        }
        .card > div > span{
            padding: 3px;
            margin: 6px;
            color: hotpink;
            font-weight: bolder;
        }
        </style>
    </div><br>
    <button class="btn" style="background:purple;color: white">Edit</button>
    
</div>
@endsection