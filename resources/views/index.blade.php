@extends('layouts.master')

@section('content')
<div class="container content">
	<div class="row">
		<h1>{{ Carbon\Carbon::now('America/Chicago')->formatLocalized('%A') }}  <small>{{ Carbon\Carbon::now('America/Chicago')->formatLocalized('%B %d, %Y') }}</small></h1>
	</div>
	<div class="row">
		<div class="col-xs-12" id="photos">
			<div id="carousel" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					@foreach ($upcomingEvents as $event)
					<li data-target="#carousel" data-slide-to="0" class=""></li>
					@endforeach
				</ol>
				<!-- Wrapper for slides -->
				<div class="carousel-inner carousel-image-container events-slider" role="listbox">
					@foreach ($upcomingEvents as $index => $event)
					<div data-value="{{ $event->id }}" class="item @if($index == 0) {{ 'active' }} @endif">
						<div class="carousel-caption">
							<h2>{{ $event->title }}</h2>
							<p> </p>
						</div>
						<img class="cover" src="{{ $event->event_pic }}" alt="{{ $event->title }}">
					</div>
					@endforeach
				</div>
				<!-- Controls -->
				<a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#carousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
	</div>
</div>
@stop
@section('scripts')
<script>
	$('#myTabs a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	});
	$('#myTabs a:first').tab('show');
	$('.carousel').carousel({
		interval: 4000
	});
	$('.events-slider').click(function (e) {
		var $eventId = $('.item').data('value');
		$(location).attr('href', '/events/' + $eventId);
	});
</script>
@stop