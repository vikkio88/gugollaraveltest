@extends('app')

@section('content')
<div id="homecontainer">
<div id="logo">
<!--<h1>Google</h1>-->
<img src="{{ asset('/img/logo.png') }}" alt="Google">
</div>
	<form action="/search" method="get" id="searchform">
	    <label for="query"></label>
	    <input autocomplete="off" type="query" id="query" name="q" size="66">
	    <div class="homebuttons">
  			<button type="button" onclick="checkSubmit()" class="btn-sm btn-default btnhome"><strong>Google search</strong></button>
  			<button type="button" onclick="checkSubmit(true)" class="btn-sm btn-default btnhome"><strong>I'm Feeling Lucky</strong></button>
  		</div>
  	</form>
</div>
@endsection
