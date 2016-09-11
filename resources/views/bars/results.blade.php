@extends('layouts.master')

@section('content')
<div class="container">
	<hr>
	@foreach ($bars as $bar)
	<div data-value="{{ $bar->id }}" class="row thisBar">
		<div class="col-xs-3">
			<img src="{{ $bar->pictures->first()->pic_url or '' }}" class="thumbnail responsive" height="100" width="100">
		</div>
		<div class="col-xs-9">
			<h2><a href="/bars/{{ $bar->id }}">{{ $bar->name }}</a></h2>
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
	@section('scripts')
	<script type="text/javascript">
		$('.thisBar').click(function () {
			$(location).attr('href', '/bars/' + $(this).data('value'));
		});
	</script>
	@stop