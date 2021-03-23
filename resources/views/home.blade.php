@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="css/style.css">

<!-- THIS IS LOAD -->
<script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
			<script>
			$(document).ready(function(){
				$(".loader").fadeOut();
				})
				</script>	
<div class="loader">
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
	</div>

<!-- THIS IS SIDEBAR -->
<div class="sidebar">
	<a href="/dashboard" style="background: darkcyan;text-decoration: overline;">Dashboard</a><br><br>
	  <div class="judul">Your Account</div><br>
	<a href="/profile">profile</a><br><br>
	<a href="tagih">Tagih</a><br><br>
	<a href="data.html">lihat data</a><br><br>
	<a href="grafik.html">statistik</a><br><br>
	<a href="pemakaian.html">aktivitas</a><br><br>

	<div class="lain">
	 <div class="judul">Setting</div><br>
		<a href="laporkan.html" style="background: blue">laporkan</a><br><br>
		<a href="login.html"style="background: red;">keluar</a><br><br>

		<!-- THIS IS OUT  -->
		<div class="out">
			<a href="index.html">What is the Simpleazy</a><br>
			<a href="rating.html">rating us</a><br>
			<a href="#">support me with ovo cash</a>
		</div>
	</div>
</div>
<br>

<!-- THIS IS UR PAGES -->
<div class="kotak">
	<div class="p">
		<h1>Owned</h1><br>
		<ol class="daftar">
            @foreach($data['owned'] as $owned)
                <li>
                    <a href="/group/{{ $owned -> id }}">{{ $owned -> name }}</a>
                </li>
            @endforeach
        </ol>
        <h1>Joined</h1><br>
        <ol class="daftar">
            @foreach($data['joined'] as $joined)
                <li>
                    <a href="/group/{{ $joined -> id }}">{{ $joined -> name }}</a>
                </li>
            @endforeach
		</ol>
    </div> <!-- this is kotak -->
<br><br>

<div class="kotak input" style="width: 300px;text-align: center;margin-top: -800px;">
	<h1>enter code</h1><br>
	<input type="number" style="height: 50px;width:250px;font-size: 2rem;">
</div><br>
<div class="hey">
	
<img src="pics/mars.png" alt="">

</div>

@endsection
