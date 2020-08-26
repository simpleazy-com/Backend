@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col"><h4>Admins</h4></div>
        <div class="col"><a href="/group/{{ $data['group_id'] }}/adminship/add" style="float:right;"><button class="btn btn-primary">Tambah Admin</button></a></div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        <?php $i = 1 ?>
        @foreach($data['users'] as $user)
            <tr>
                <th scope="row">{{ $i }} </th>
                <td>{{ $user->name }} </td>
                <td><a href=""><button class="btn btn-danger" style="float:right;">Demote</button></a></td>
            </tr>
            <?php $i++ ?>
        @endforeach
        </tbody>
    </table>
</div>
@endsection