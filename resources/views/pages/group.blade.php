@extends('layouts.app')

@section('content')
<div class="konten">
    <div class="group-button">
        <div class="p-3"><a href="/group/create"><span class="fa fa-plus-square"></span> Tambah Group</a></div>
        <div class="p-3"><a href="/group/join"><span class="fa fa-sign-in-alt"></span> Gabung Group</a></div>
    </div>
    <h4 class="pl-3">Group Owned</h4>
    <div class="d-flex flex-wrap group-content">
        @foreach ($data['owned'] as $owned)
            <div class="p-2">
                <h5 class="card-title">
                    <a href="/group/{{ $owned -> id }}/settings"><span class="fa fa-cog h5 float-right"></span></a>
                    <a href="/group/{{ $owned -> id }}">{{ $owned -> name }}</a>
                </h5>
                <p class="card-text">{{ $owned -> description }}</p>
                <p class="card-text h6">-Pembuat Group-</p>
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
                    <a href="/group/{{ $joined -> id }}/settings"><span class="fa fa-cog h5 float-right"></span></a>
                    <a href="/group/{{ $joined -> id }}">{{ $joined -> name }}</a>
                </h5>
                <p class="card-text">{{ $joined -> description }}</p>
                <p class="card-text h6">-Pembuat Group-</p>
                <hr>
                <div class="group-payment-reminder">
                    <!-- Daftar Tagihan yang akan datang -->
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection


