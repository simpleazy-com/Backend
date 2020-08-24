@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Member</h4>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1 ?>
            @foreach($memberList as $member)
                <tr>
                    <th scope="row">{{ $i }} </th>
                    <td>{{ $member->name }} </td>
                    <td>{{ $member->isAdmin == 1?"Admin":"Member" }} </td>
                </tr>
                <?php $i++ ?>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection