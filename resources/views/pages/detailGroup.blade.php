@extends('layouts.app')

@section('content')
<?php $group = $data['group']; ?>
<div class="konten group-detail-konten">
    <div class="jumbotron group-detail-jumbotron">
        <div class="container">
            <a class="putih" href="/group/{{ $group -> id }}/settings"><span class="fa fa-cog h5 float-right"></span></a>
            <h1>{{ $group -> name }}</h1>
            <p class="lead">{{ $group -> description }}</p>
        </div>
    </div>
    <div class="group-detail-flex">
        <div class="group-detail-list-payment">
            @foreach($data['payment'] as $payment)
            <div class="group-detail-payment">
                <h1><a href="/group/{{ $group -> id }}/payment/{{ $payment -> id }}">Rp. {{ $payment -> nominal }}</a></h1>
                <p>Batas Waktu : {{ $payment -> deadline }}</p>
            </div>
            @endforeach
        </div>
        <div class="group-detail-list-button">
            <a href="/group/{{ $group->id }}/member">Member</a>
            <a href="/group/{{ $group->id }}/info">Group Info</a>
            <a href="/group/{{ $group->id }}/payment">List Payment</a> <!--untuk lihat semua tagihan (belum bayar, tidak membayar, sudah dibayar)-->
            <a href="/group/{{ $group->id }}/adminship">Adminship (khusus owner)</a>
            <a href="/group/{{ $group->id }}/paymentadmin">Payment (khusus admin)</a>
        </div>
    </div>
</div>
@endsection