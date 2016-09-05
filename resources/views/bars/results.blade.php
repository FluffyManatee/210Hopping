@extends('layouts.master')

@section('content')
<div class="container">
	@foreach ($bars as $bar)
	<div class="row">
		<div class="col-xs-3">
			<img src="" class="thumbnail responsive" height="100" width="100">
		</div>
		<div class="col-xs-9">
			<h2>{{ $bar->name }}</h2>
			<p><a href="http://maps.apple.com/?q={{ $bar->address }}"><strong>{{ $bar->address}}</strong></a>
				| <a href="tel:{{ $bar->phone }}">{{ $bar->formatPhoneNumber() }}</a></p>
				@if ($bar->averageBarRating() != null)
				<p class="beer-rating">{!! $bar->averageBarRating() !!}</p>
				@else
				no ratings yet
				@endif
			</div>
		</div>
		<hr>
		@endforeach
	</div>
	@stop