@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Owned</h4>
    <div class="container">
        <div class="row row-cols-4">
            @foreach ($data['owned'] as $owned)
                <div class="card col" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><a href="/group/{{$owned->id}}">{{ $owned -> name}}</a></h5>
                        <p class="card-text"> {{ $owned -> description }} </p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <!-- <li class="list-group-item"><a href="/group/{{$owned->id}}">Detail Group</a></li> -->
                    </ul>
                    <div class="card-body">
                        <a href="/group/{{$owned->id}}/settings" class="card-link">Settings</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <h4>Joined</h4>
    <div class="container">
        <div class="row row-cols-4">
            @foreach ($data['joined'] as $joined)
                <div class="card col" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><a href="/group/{{$joined->id}}">{{ $joined -> name}}</a></h5>
                        <p class="card-text"> {{ $joined -> description }} </p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <!-- <li class="list-group-item"><a href="/group/{{$joined->id}}">Detail Group</a></li> -->
                    </ul>
                    <div class="card-body">
                        <a href="/group/{{$joined->id}}/settings" class="card-link">Settings</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection