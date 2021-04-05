@extends('layouts.app')

@section('content')
<div class="konten group-detail-payment-konten">
    <div class="group-detail-payment-flex">
        <div class="group-detail-payment-payment">
            <h1><a href="" class="putih">Rp. 50000</a></h1>
            <p>Batas Waktu : 25-Maret-2021</p>
            <p class="tidak-lunas">Tidak lunas</p>
        </div>
        <div class="group-detail-payment-payment">
            <h1><a href="" class="putih">Rp. 50000</a></h1>
            <p>Batas Waktu : 20-Maret-2021</p>
            <p class="lunas">Lunas</p>
        </div>
        <div class="group-detail-payment-payment">
            <h1><a href="" class="putih">Rp. 50000</a></h1>
            <p>Batas Waktu : 12-Maret-2021 (sudah terlewat)</p>
            <p class="tidak-lunas">Tidak Lunas</p>
        </div>
        <div class="group-detail-payment-payment">
            <h1><a href="" class="putih">Rp. 50000</a></h1>
            <p>Batas Waktu : 10-Maret-2021 (sudah terlewat)</p>
            <p class="lunas">Lunas</p>
        </div>
    </div>
</div>
@endsection