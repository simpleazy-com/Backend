@extends('layouts.app')
<style>@import url('https://fonts.googleapis.com/css2?family=Fira+Code:wght@500&display=swap');

*{
  color: white;
  font-family: 'Fira Code', monospace;
}
body{
  background-color: #1B1B32;
}
.card{
    background-color:indigo;
    color: white;
}
.card-header{
  background-color: indigo;
}
.card-body{
  background-color: purple;
}
button{
  background-color: #6574cd;
  color: white;
}
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background: purple;
            color: white;
            border-bottom: 8px solid indigo;">
                <div class="card-header" style="background: indigo;color:white">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
