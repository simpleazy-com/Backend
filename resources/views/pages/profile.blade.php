@extends('layouts.app')

@section('content')
<div class="konten">
    <div class="profile-flex">
        <div class="profile-image">
            <img src="https://cdn2.iconfinder.com/data/icons/4web-3/139/header-account-image-line-512.png"/>
        </div>
        <div class="profile-desc">
            <div class="profile-desc-content">Nama : {{ $data -> name }}</div>
            <div class="profile-desc-content">Email : {{ $data -> email }}</div>
        </div>
        <div class="profile-button">
            <a href="/profile/edit" class="btn">Edit</a>
        </div>
    </div>
</div>
@endsection