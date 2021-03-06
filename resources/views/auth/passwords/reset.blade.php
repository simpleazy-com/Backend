@extends('layouts.app')

@section('content')
<style>
*{
    padding: 0;
    margin: 0;
}

.card{
    width: 30%;
    margin: 50px auto;
}

.login-option{
    display: flex;
    flex-direction: column;
    align-items: center;
}

.option-text{
    font-size: 14px;
}

.option-google{
    text-decoration: none;
    color: black;
}

.user{
    display: block;
    float: right;
}

.container{
    margin-top: 50px;
}

.box{
    height: 150px;
}
@media (max-width: 800px) {
    .card{
        width: 80%;
        margin: 50px auto;
    }
}</style>
    <div class="card">
        <div class="card-header text-center">
            <h3>Reset Password</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">
                          <i class="fas fa-envelope-square"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">
                          <i class="fa fa-key"></i>
                        </span>
                    </div>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Password" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                 <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">
                        <i class="fas fa-check"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <button type="submit" class="btn btn-primary btn-block"> {{ __('Reset Password') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
