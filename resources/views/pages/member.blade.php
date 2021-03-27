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
           
            </tbody>
        </table>
        <h5>Pending</h5>
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
            @foreach($pending as $member)
                <form action="/group/{{ Request::route('id') }}/pending" method="POST">
                    @csrf
                    <tr>
                        <th scope="row">{{ $i }} </th>
                        <td>{{ $member->name }} </td>
                        <input type="hidden" name="user_id" value="{{ $member->user_id }}">
                        <input type="hidden" name="group_id" value="{{ $member->group_id }}">
                        <td><button type="submit" value="accepted" name="status">Accept</button></td>
                        <button type="submit" value="rejected" name="status">Reject</button>
                    </tr>
                    <?php $i++ ?>
                </form>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection