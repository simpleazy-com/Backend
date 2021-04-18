@extends('layouts.app')

@section('content')
<div class="konten member-konten">
    <div class="container member-kontener">
        <h4>Member</h4>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($listPayment as $lp)
            <form action="/group/{{ Request::route('id') }}/payment/{{ Request::route('payment_id') }}" method="POST">
                <tr>
                @csrf
                    <td>{{ $lp->name }}</td>
                    <td>Rp. {{ $lp->nominal }}</td>
                    <td>{{ $lp->status }}</td>
                    <input type="hidden" name="index_row" value="{{ $lp->index_row }}">
                    <input type="hidden" name="member_id" value="{{ $lp->member_id }}">
                    @if($lp -> status != "sudah_bayar")
                    <td>
                        <div class="profile-button">
                            <button type="submit" class="btn" name="status" value="dibayar">Dibayar</button>
                        </div>
                    </td>
                    @endif
                </tr>
            </form>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

