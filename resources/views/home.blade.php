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
                        <li class="list-group-item"><a href="/group/create">Create Group</a></li>
                        <li class="list-group-item"><a href="/group/join">Join Group</a></li>
                    </ul>
                    Branch
                    <ul class="list-group">
                    @foreach ($id as $ids)
                    <li class="list-group-item"><a href="/group/{{$ids->id}}/member">Member List</a></li>
                    <li class="list-group-item"><a href="/group/{{$ids->id}}/settings">Settings</a></li>
                    <li class="list-group-item"><a href="/group/{{$ids->id}}/adminship">Adminship</a></li>
                    <li class="list-group-item"><a href="/group/{{$ids->id}}/adminship/add">Add Adminship</a></li>
                    <li class="list-group-item"><a href="/group/{{$ids->id}}/payment">Member Payment List</a></li>
                    <li class="list-group-item"><a href="/group/{{$ids->id}}/payment/list">Payment List</a></li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
