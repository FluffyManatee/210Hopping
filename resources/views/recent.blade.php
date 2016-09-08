@extends('layouts.master')

@section('content')
<div class="row" id="bar-reviews">
	<div class="col-xs-12">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" id="myTabs" role="tablist">
			<li role="presentation" class="active"><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Bars</a></li>
			<li role="presentation" class=""><a href="#events" aria-controls="specials" role="tab" data-toggle="tab">Events</a></li>
			<li role="presentation" class=""><a href="#specials" aria-controls="events" role="tab" data-toggle="tab">Specials</a></li>
			<li role="presentation" class=""><a href="#gameplans" aria-controls="events" role="tab" data-toggle="tab">Gameplans</a></li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="reviews">
				@foreach ($recent['bars'] as $bar)
					<div data-value="{{ $bar->id }}" class="row thisBar">
						<div class="col-xs-2">
							<img src="" class="thumbnail responsive" height="100" width="100">
						</div>
						<div class="col-xs-9">
							<h2>{{ $bar->name}}</h2>
							<p><a href="http://maps.apple.com/?q={{ $bar->address }}"><strong>{{ $bar->address}}</strong></a>
								| <a href="tel:{{ $bar->phone }}">{{ $bar->formatPhoneNumber() }}</a></p>
							@if ($bar->averageBarRating() != null)
								<p class="beer-rating">{!! $bar->averageBarRating() !!}</p> &nbsp; {{ count($bar->reviews) }} reviews
							@else
								no ratings yet
							@endif
						</div>
					</div>
					<hr>
				@endforeach
			</div>
			<div role="tabpanel" class="tab-pane fade" id="events">
				@foreach($recent['events'] as $event)
				<div class="row">
					<h2>{{ $event->title }}</h2>
					<a href="/events/{{ $event->id }}">eventpage</a>
				</div>
				<hr>
				@endforeach
			</div>
			<div role="tabpanel" class="tab-pane fade" id="specials">
				@foreach($recent['specials'] as $special)
				<div class="row">
					<div class="col-xs-3">
						<h1>{{$special->title}}</h1>
						<a href="/specials/{{ $special->id }}">specialpage</a>
					</div>
				</div>
				<hr>
				@endforeach
			</div>
			<div role="tabpanel" class="tab-pane fade" id="gameplans">
				@foreach($recent['gameplans'] as $gameplan)
					<div class="row">
						<h2>{{ $gameplan->date }}</h2>
						<h2>{{ $gameplan->time }}</h2>
						<a href="/events/{{ $gameplan->id }}">gameplanpage</a>
					</div>
					<hr>
				@endforeach
			</div>
		</div>
	</div>
</div>
@stop