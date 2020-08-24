@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">{{ $group -> name }}</h1>
            <p class="lead">{{ $group -> description }}</p>
            <div class="container"> 
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
            <div class="col-md-9 border">Buat Payment <br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, aperiam animi? Ratione iure, doloremque ea neque dolore dolorum. Sit harum cum eum aut facere fuga aliquid odio! Blanditiis, eveniet aliquid. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia minima facere corporis dicta debitis aspernatur nesciunt qui, quod ullam praesentium obcaecati minus enim aliquid ab voluptatum tempora mollitia totam odit. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis suscipit mollitia quae perspiciatis exercitationem laborum quis cum, libero expedita? Minus beatae repellendus nihil commodi distinctio nobis ipsa aspernatur totam at?</div>
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