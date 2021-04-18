@extends('layouts.app')

@section('content')
<div class="konten">
    <div class="group-form-flex p-3">
        <form action="/group/{{Request::route('id')}}/payment/add" method="post">
        @csrf
            <div class="form-group">
                <label for="inputnominal">Nominal</label>
                <input type="number" name="nominal" id="inputnominal" class="form-control" placeholder="e.g : 100000">
            </div>
            <div class="form-group">
                <label for="checkboxes">Pilih member</label>
                <div id="checkboxes">
                    @foreach ($memberList as $ml)
                    <div class="checkbox">
                        <label><input type="checkbox" name="selected_member[]" value="{{ $ml -> id }}">{{ $ml -> name }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label for="inputdeadline">Deadline</label>
                <input type="date" name="deadline" id="inputdeadline" class="form-control">
            </div>
            <div class="profile-button">
                <button type="submit" class="btn">Buat</button>
            </div>
        </form>
    </div>
</div>
@endsection