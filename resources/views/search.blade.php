@extends('app')

@section('content')
<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<span>
				<a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('/img/logo.png') }}" alt="Google" class="img-responsive logosmall"></a>
</span>
<span>
						<form action="/search" method="get" id="searchform">
	    <label for="query"></label>
	    <input type="query" id="query" name="q" size="30" value="{{$query}}">
  			<button type="button" onclick="checkSubmit()" class="btn-sm btn-default btnhome"><strong>Google search</strong></button>
  	</form>
  	</span>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				

				<ul class="nav navbar-nav navbar-right">
					<li>Gmail</li>
				</ul>
			</div>
		</div>
	</nav>

<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="activegoogle"><a href="{{ url('/') }}">Web</a></li>
					<li><a href="{{ url('/') }}">News</a></li>
					<li><a href="{{ url('/') }}">Images</a></li>
				</ul>
			</div>
		</div>
	</nav>

<div class="container container-result">
	<div class="row search-row">
		<div class="col-md-90">
			<div class="panel panel-default">
				<!--<div class="panel-heading">Home</div>-->

@if (count($links)>0)
<div id="resultstat"> About {{$stats->total}} results ({{round($stats->elapsed, 2, PHP_ROUND_HALF_DOWN)}} seconds) </div>

<ul id="resultset">
	@foreach ($links as $link)
    	<li class="result"> 	
	    	<div class="result-title">
	    		<a href="{{$link->url}}" title="{{$link->title}}">{{$link->title}}</a>
	    	</div>
	    	<div class="result-subtitle">
	    		{{$link->url}} <span class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
	    	</div>
	    	<div class="result-body">
	    		{{$link->description}}...
	    	</div>
    	</li>
	@endforeach
<div id="pagination"> </div>
</ul>
@else
	Your search - <strong>{{$query}}</strong> - did not match any documents.
	<br />
	Suggestions:<br />
	<ul>
	<li>Make sure that all words are spelled correctly.</li>
	<li>Try different keywords.</li>
	<li>Try more general keywords.</li>
	</ul>
@endif

</div>
		
</div>
</div>
</div>
@endsection