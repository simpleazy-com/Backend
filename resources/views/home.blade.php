@extends('layouts.app')

@section('content')
<style><style>
@import url('https://fonts.googleapis.com/css2?family=Fira+Code:wght@500&display=swap');

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
}</style></style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="list-group-item"><a href="/profile">Profile</a></li>
                        <li class="list-group-item"><a href="/mail">Mail #Acan aya</a></li>
                        <li class="list-group-item"><a href="/group">Group</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
