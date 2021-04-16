@extends('layouts.app')

@section('content')
<div class="konten">
    <div class="konten group-form-content">
        <div class="group-form-flex p-3">
            <form action="/profile/edit" method="post">
            @csrf
                <input type="hidden" name="id" value="{{ $data[0] -> id }}">
                <div class="form-group">
                    <label for="inputname">Nama</label>
                    <input type="text" name="name" id="inputname" class="form-control" placeholder="e.g : Simple-Chan" value="{{ $data[0] -> name }}" required>
                </div>
                <div class="form-group">
                    <label for="inputemail">Email</label>
                    <input type="email" name="email" id="inputemail" class="form-control" placeholder="e.g : simplechan@mail.id" value="{{ $data[0] -> email }}" required>
                </div>
                <div class="profile-button">
                    <button type="submit" class="btn">Save</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection