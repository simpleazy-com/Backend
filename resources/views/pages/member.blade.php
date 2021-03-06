@extends('layouts.app')

@section('content')
<div class="konten member-konten">
    @if(Session::has('success'))
    <div class="alert alert-success mt-4">
        {{ session('success') }}
    </div>
    @endif
    <div class="container member-kontener">
        <h4>Member</h4>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    @if($role == 1)
                    <th scope="col">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            <?php $i = 1 ?>
            @foreach($memberList as $member)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->isAdmin ? 'Admin' : 'Member' }}</td>
                    @if($role == 1)
                    <td>
                        <form method="post" action="/group/{{Request::route('id')}}/member/kick">
                        @csrf
                            <input type="hidden" name="user_id" value="{{ $member -> id }}">
                            <button class="btn btn-danger" type="submit">Kick</button>
                        </form>
                    </td>
                    @endif
                </tr>
                <?php $i++ ?>
            @endforeach
            </tbody>
        </table>

        <!-- Khusus Admin / Owner-->
        <h5>Pending</h5>
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
            @foreach($pending as $member)
                <form action="/group/{{ Request::route('id') }}/pending" method="POST">
                    @csrf
                    <tr>
                        <th scope="row">{{ $i }} </th>
                        <td>{{ $member->name }} </td>
                        <input type="hidden" name="user_id" value="{{ $member->user_id }}">
                        <input type="hidden" name="group_id" value="{{ $member->group_id }}">
                        <td><button type="submit" class="btn btn-success" value="accepted" name="status">Accept</button>
                        <button type="submit" value="rejected" class="btn btn-danger" name="status">Reject</button></td>
                    </tr>
                    <?php $i++ ?>
                </form>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection