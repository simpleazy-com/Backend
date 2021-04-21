@extends('layouts.app')

@section('content')
<div class="konten">
    @if(Session::has('success'))
    <div class="alert alert-success mt-4">
      <p>{{ session('success') }}</p>
    </div>
    @endif
    <div class="group-detail-admin-payment-button">
        <a href="/group/{{ $data['id'] }}/payment/add" class="putih"><span class="fa fa-plus-square"></span> Tambah Tagihan</a>
    </div>
    <div class="group-detail-payment-flex">
    <?php $i = 0?>
    @foreach($data['payment'] as $payment)
        <div class="group-detail-payment-payment">
            <form action="/group/{{ $data['id'] }}/paymentadmin/delete" method="post">
            @csrf
                <input type="hidden" name="payment_id" value="{{ $payment -> id }}">
                <button class="btn btn-danger float-right" type="submit">Hapus</button>
            </form>
            <h1><a href="/group/{{ $data['id'] }}/payment/{{ $payment ->id }}" class="putih">Rp. {{ $payment -> nominal }} ({{ $data['perbandingan_jumlah_tagihan'][$i]['sudah_bayar'] }}/{{ $data['perbandingan_jumlah_tagihan'][$i]['total_tagihan'] }})</a></h1>
            <p>Batas Waktu : {{ $payment -> deadline }}</p>
        </div>
        <?php $i++?>
    @endforeach
    </div>
</div>
@endsection