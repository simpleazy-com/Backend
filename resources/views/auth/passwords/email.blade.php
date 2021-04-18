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
}</style>
    <div class="card">
        <div class="card-header text-center">
            <h3>Forgot Password</h3>
        </div>
        <div class="card-body">
             @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                 <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">
                          <i class="fa fa-envelope-square"></i>
                        </span>
                    </div>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                     @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group input-group-sm mb-3">
                    <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
