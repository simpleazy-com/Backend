@extends('layouts.app')
@section('content')
<div class="konten">
    <div class="d-flex flex-wrap home-flex">
        <a href="/profile">
            <div class="p-2">
                Profile<br>
                <img src="https://cdn2.iconfinder.com/data/icons/4web-3/139/header-account-image-line-512.png"/>
            </div>
        </a>
        <a href="/group">
            <div class="p-2">
                Group<br>
                <img src="https://image.flaticon.com/icons/png/512/166/166289.png" alt="" srcset="">
            </div>
        </a>
        <a href="/mail">
            <div class="p-2">
                Mail<br>
                <img src="https://www.iconpacks.net/icons/1/free-mail-icon-142-thumb.png" alt="">
            </div>
        </a>
        <a href="/setting">
            <div class="p-2">
                Setting<br>
                <img src="https://pics.freeicons.io/uploads/icons/png/17773426191535958157-512.png"/>
            </div>
        </a>
    </div>
</div>
@endsection