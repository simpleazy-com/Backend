@extends('layouts.app')

@section('content')
<div class="konten group-form-content">
    <div class="group-form-flex p-3">
    @foreach ($users as $user)
        <form action="/group/{{Request::route('id')}}/adminship/add" method="POST">
            <div class="form-group">
                @csrf
                <div class="container group-detail-adminship-tambah">
                    <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                    <p class="p-2">{{ $user -> name }}</p>
                    <select name="role" class="form-control">
                    @foreach ($roles as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                        <!-- <option value="admin">Admin</option> -->
                    @endforeach
                    </select>
                    <div class="profile-button pl-2">
                        <button type="submit" class="btn">Change Role</button>
                    </div>
                </div>
            </div>
        </form>
    @endforeach
    </div>
</div>
@endsection
