@extends('app')

@section('content')
<nav class="navbar navbar-default navbarsearch">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="topwrapper">
					<span class="logotop">
						<a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('/img/logo.png') }}" alt="Google" class="img-responsive logosmall"></a>
					</span>

					<span class="searchbartop">

					<form class="navbar-form" action="/search" method="get" id="searchform">
					    <div class="input-group add-on">
					      <input autocomplete="off" type="text" size="80" class="form-control" placeholder="Search" name="q" id="query" value="{{$query}}">
					      <div class="input-group-btn">
					        <button class="btn btn-default btnsearch" onclick="checkSubmit()" type="submit"><i class="glyphicon glyphicon-search"></i></button>
					      </div>
					    </div>
					  </form>

					</span>
				</div>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li>Gmail</li>
				</ul>
			</div>
		</div>
	</nav>

<nav class="navbar navbar-default navbarundersearch">
		<div class="container-fluid">
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="activegoogle"><a href="{{ url('/') }}">Web</a></li>
					<li><a href="{{ url('/') }}">News</a></li>
					<li><a href="{{ url('/') }}">Images</a></li>
				</ul>
			</div>
		</div>
</nav>

<div class="container-result">

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

	@if ($stats->total > 10)
	<hr />
	<div id="pagination">
	<ul class="pages">

		@for ($i = 1; $i < $stats->max; $i++)
			@if($i != $stats->currentPage)
	    		<li class="page"><a href="{{ URL::current().'?q='.$query.'&p='.$i }}"> {{ $i }} </a> <li>
	    	@else
	    		<li class="page current-page"><a href="{{ URL::current().'?q='.$query.'&p='.$i }}"> {{ $i }} </a> <li>
	    	@endif
		@endfor
	</ul>
	</div>
	@endif
</ul>
@else
	<div class="result-error"> 
		Your search - <strong>{{$query}}</strong> - did not match any documents.
		<br />
		Suggestions:<br />
		<ul>
		<li>Make sure that all words are spelled correctly.</li>
		<li>Try different keywords.</li>
		<li>Try more general keywords.</li>
		</ul>
	</div>
@endif
</div>

@if (count($links)>4)
<footer class="footer">
@else 
<footer class="footerfixed">
@endif
		<div class="container-fluid">
			
			
				<ul class="nav navbar-nav navfoot">
					<li><a href="{{ url('/') }}">Stuff</a></li>
					<li><a href="{{ url('/') }}">Other Stuff</a></li>
					<li><a href="{{ url('/') }}">Stuffette</a></li>
				</ul>
		</div>
</footer>

@endsection