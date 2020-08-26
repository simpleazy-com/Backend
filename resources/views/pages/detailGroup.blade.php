@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">{{ $group -> name }}</h1>
            <p class="lead">{{ $group -> description }}</p>
            <div class="container"> 
                <a href="/group/{{ $group -> id }}/settings "><button class="btn btn-primary">Settings</button></a>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    More
                </button>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <p class="lead">Mode : {{ $group -> mode }}</p>
                        <p class="lead">Code : {{ $group -> code }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row row-cols-2">
            <div class="col-md-9 border">

            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <a href="#"><h5 class="card-title">Minggu Pertama</h5></a>
                    <h6 class="card-subtitle mb-2 text-muted">Paid</h6>
                    <p class="card-text alert alert-success">Rp. 50,000</p>
                </div>
            </div>

        </div>
            <div class="col-5 col-md-3 border">
                <ul class="list-group">
                    <li class="list-group-item"><a href="/group/{{$group->id}}/member">Member</a></li>
                    <li class="list-group-item"><a href="/group/{{$group->id}}/adminship">Adminship</a></li>
                    <li class="list-group-item"><a href="/group/{{$group->id}}/payment">Payment</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection