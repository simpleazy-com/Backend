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
}
</style>
<div class="card">
        <div class="card-header text-center">
            <h3>Login</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">
                          <i class="fas fa-envelope-square"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                <div>
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Remember me!</label>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
                <div class="login-option">
                    <div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                <p class="option-text">{{ __('Forgot Your Password?') }}</p>
                            </a>
                        @endif
                    </div>
                    <div>
                        <p class="option-text">New to simpleazy? <a href="/register">Create an account here!</a></p>
                    </div>
                    <div>
                        <p class="option-text">Or Login with</p>
                    </div>
                    <div>
                        <a href="/redirect" class="option-google"><i class="fab fa-google"></i></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
