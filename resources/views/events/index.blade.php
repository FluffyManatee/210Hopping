@extends('layouts.master')

@section('content')
<div class="container">
	<hr>
	@foreach ($events as $event)
	<div class="row">
		<div class="col-xs-3">
		<img  class="thumbnail" src="{{$event->event_pic}}" style="height: 20vh;width: 100%;object-fit: cover;object-position: 50% 50%;">
		</div>
		<div class="col-xs-6">
			<h3>{{ $event->title }}</h3>
			<div class="event-info">
				<a href="/bars/{{ $event->bar_id }}" style="font-size:17px;font-weight:bold;"><p>{{ $event->bar->name }}</p></a>
				<p>{{ $event->date->format('F jS, Y') }}</p>
				<p>@ {{ $event->date->format('h:i A') }}</p>
			</div>
		</div>
		<div class="col-xs-3">
			<a class="btn btn-primary pull-right foreached-button" href="/events/{{ $event->id }}">View Event</a>
		</div>
	</div>
	<hr>
	@endforeach
</div>
{{--{!! $events->render() !!}--}}
@stop