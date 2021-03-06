@extends('layouts.app')

@section('content')
<div class="konten">
    @if(Session::has('success'))
    <div class="alert alert-success mt-4">
        <p>{{ session('success') }}</p>
    </div>
    @endif
    <div class="group-button">
        <div class="p-3"><a href="/group/create"><span class="fa fa-plus-square"></span> Tambah Group</a></div>
        <div class="p-3"><a href="/group/join"><span class="fa fa-sign-in-alt"></span> Gabung Group</a></div>
    </div>
    <h4 class="pl-3">Group Owned</h4>
    <div class="d-flex flex-wrap group-content">
        @foreach ($data['owned'] as $owned)
            <div class="p-2">
                <h5 class="card-title">
                    <a href="/group/{{ $owned -> group_id }}/settings"><span class="fa fa-cog h5 float-right"></span></a>
                    <a href="/group/{{ $owned -> group_id }}">{{ $owned -> name }}</a>
                </h5>
                <p class="card-text">{{ $owned -> description }}</p>
                <p class="card-text h6">{{ $owned -> user_name }}</p>
                <hr>
                <div class="group-payment-reminder">
                    <!-- Daftar Tagihan yang akan datang -->
                </div>
            </div>
        @endforeach
    </div>
    <h4 class="pl-3">Group Joined</h4>
    <div class="d-flex flex-wrap group-content">
        @foreach ($data['joined'] as $joined)
            <div class="p-2">
                <h5 class="card-title">
                    <a href="/group/{{ $joined -> group_id }}/settings"><span class="fa fa-cog h5 float-right"></span></a>
                    <a href="/group/{{ $joined -> group_id }}">{{ $joined -> name }}</a>
                </h5>
                <p class="card-text">{{ $joined -> description }}</p>
                <p class="card-text h6">{{ $joined -> owner_name }}</p>
                <hr>
                <div class="group-payment-reminder">
                    <!-- Daftar Tagihan yang akan datang -->
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection


