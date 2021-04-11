@extends('layouts.app')

@section('content')
<div class="konten member-konten">
    <div class="container member-kontener">
        <h4>Member</h4>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tagihan</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1 ?>
            @foreach($listPayment as $lp)
                <tr>
                    <td>{{ $i }}</td>
                    <td>Ke-{{ $lp->index_row }}</td>
                    <td>{{ $lp->nominal }}</td>
                    <td>{{ $lp->deadline }}</td>
                    <td>
                    <form method="post" action="/group/{{Request::route('id')}}/payment/{{$lp->id}}/report/export">
                        @csrf
                            <button class="btn btn-success" type="submit">Export</button>
                    </form>
                    </td>
                </tr>
                <?php $i++ ?>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection