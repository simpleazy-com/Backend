@extends('layouts.app')

@section('content')
<div class="konten">
<table>
<tr>
        <th>member id</th>
        <th>nominal</th>
        <th>index row</th>
        <th>status</th>
        <th colspan="2">Aksi</th>
    </tr>
    
@foreach($listPayment as $lp)
<form action="/group/{{ Request::route('id') }}/payment/{{ Request::route('payment_id') }}" method="POST">

        <tr>
        @csrf
            <td>{{ $lp->member_id }}</td>
            <td>{{ $lp->nominal }}</td>
            <td>{{ $lp->index_row }}</td>
            <td>{{ $lp->status }}</td>
            <input type="hidden" name="index_row" value="{{ $lp->index_row }}">
            <input type="hidden" name="member_id" value="{{ $lp->member_id }}">
            <td><button type="submit" name="status" value="dibayar">Dibayar {{ $lp->member_id }}</button></td>
        </tr>
        </form>
    @endforeach

</table>
</div>
@endsection