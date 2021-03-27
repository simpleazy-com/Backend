@extends('layouts.app')

@section('content')
<div class="konten group-form-content">
    <div class="group-form-flex p-3">
        <form action="/group/{{$group->id}}/settings" method="post">
            @csrf
            <div class="form-group">
                <label for="inputname">Nama Group</label>
                <input type="text" name="name" id="inputname" class="form-control" placeholder="e.g : Kelas Simpleazy" value="{{ $group -> name }}">
            </div>
            <div class="form-group">
                <label for="inputdescription">Deskripsi</label>
                <textarea name="description" id="inputdescription" class="form-control" rows="4" placeholder="e.g : Kas Bulanan Member Komunitas Simpleazy">{{ $group -> description }}</textarea>
            </div>
            <div class="form-group">
                <label for="inputmode">Mode</label>
                <select name="mode" id="inputmode" class="form-control">
                    @foreach($mode as $m)
                    <option value="{{ $m }}">{{ $m }}</option>
                    @endforeach
                </select>
            </div>
            <div class="profile-button">
                <button type="submit" class="btn">Buat</button>
            </div>
        </form>
    </div>
</div>
@endsection