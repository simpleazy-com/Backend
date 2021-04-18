@extends('layouts.app')

@section('content')
<div class="konten member-konten">
    <div class="container member-kontener">
        <!-- Khusus Admin / Owner-->
        <h5>Admin
            <a href="/group/{{ $data['group_id'] }}/adminship/add" class="putih float-right">
                <span class="fa fa-plus-square"></span>
            </a>
        </h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1 ?>
            @foreach($data['users'] as $user)
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $user -> name }}</td>
                    <td>
                        <form action="/group/{{ $data['group_id'] }}/adminship/demote" method="post">
                            @csrf
                            <input type="hidden" value="{{ $user -> user_id }}" name="user_id">
                            <button class="btn btn-danger" type="submit">Demote</button>
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