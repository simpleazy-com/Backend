@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="list-group-item"><a href="/profile">Profile</a></li>
                        <li class="list-group-item"><a href="/mail">Mail #Acan aya</a></li>
                        <li class="list-group-item"><a href="/group">Group</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
