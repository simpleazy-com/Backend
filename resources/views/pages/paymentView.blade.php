@extends('layouts.app')

@section('content')
<div class="konten group-detail-payment-konten">
    <div class="group-detail-payment-flex">
    @foreach($data['konten'] as $data)
        <div class="group-detail-payment-payment">
            <h1><a href="" class="putih">Rp. {{ $data -> nominal }}</a></h1>
            <p>Batas Waktu : {{ $data -> deadline }}</p>
            <p class="{{ $data -> status == 'belum_bayar' ? 'tidak-lunas' : 'lunas'}}">{{ $data -> status }}</p>
        </div>
    @endforeach
    </div>
</div>
@endsection