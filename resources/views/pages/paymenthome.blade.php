@extends('layouts.app')

@section('content')
<div class="konten">
    <div class="group-detail-admin-payment-button">
        <a href="/group/{{ $group -> id }}/tambah" class="putih"><span class="fa fa-plus-square"></span> Tambah Tagihan</a>
    </div>
    <div class="group-detail-payment-flex">
        <div class="group-detail-payment-payment">
            <form action="" method="post">
                <button class="btn btn-danger float-right" type="submit">Hapus</button>
            </form>
            <h1><a href="" class="putih">Rp. 50000 (10/35)</a></h1>
            <p>Batas Waktu : 25-Maret-2021</p>
        </div>
        <div class="group-detail-payment-payment">
            <form action="" method="post">
                <button class="btn btn-danger float-right" type="submit">Hapus</button>
            </form>
            <h1><a href="" class="putih">Rp. 50000 (30/35)</a></h1>
            <p>Batas Waktu : 20-Maret-2021</p>
        </div>
        <div class="group-detail-payment-payment">
            <form action="" method="post">
                <button class="btn btn-danger float-right" type="submit">Hapus</button>
            </form>
            <h1><a href="" class="putih">Rp. 50000 (33/35)</a></h1>
            <p>Batas Waktu : 12-Maret-2021 (sudah terlewat)</p>
        </div>
        <div class="group-detail-payment-payment">
            <form action="" method="post">
                <button class="btn btn-danger float-right" type="submit">Hapus</button>
            </form>
            <h1><a href="" class="putih">Rp. 50000 (35/35)</a></h1>
            <p>Batas Waktu : 10-Maret-2021 (sudah terlewat)</p>
        </div>
</div>
@endsection