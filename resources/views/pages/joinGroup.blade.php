@extends('layouts.app')

@section('content')
<div class="konten group-form-content">
    <div class="group-form-flex p-3">
        <form action="/group/join" method="post">
        @csrf
            <div class="form-group">
                <label for="inputname">Code</label>
                <input type="text" name="code" id="inputname" class="form-control" placeholder="e.g : ka8bca2n">
            </div>
            <div class="profile-button">
                <button type="submit" class="btn">Gabung</button>
            </div>
        </form>
    </div>
</div>
@endsection