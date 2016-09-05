@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-3">
			<img class="img img-thumbnail" src="{{ $user->avatar }}" height="150" width="150">
		</div>
		<div class="col-xs-6">
			<h2>{{ $user->first_name }} {{ $user->formatLastName() }}.</h2>
			Hopper since {{ $user->created_at->format('F Y') }}
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-3">
			{{ $user->totalUserVotes() }}
		</div>
		<div class="col-xs-6">
			<h3>Reviews</h3>
			<hr>
			@foreach ($user->reviews as $review)
			<div class="row">
				<div class="col-xs-2">
					<img src="" class="thumbnail responsive" height="65" width="65">
				</div>
				<div class="col-xs-6">
					<a href="/bars/{{ $review->bar_id }}"><strong>{{ $review->bar->name }}</strong></a>
					<div class="user-page-review-info">avg price | {{ $review->bar->type }}</div>
					<div class="user-page-review-info">{{ $review->bar->address }}</div>
				</div>
			</div>
			<p class="beer-rating">{!! $review->beerRating() !!}</p> &nbsp; {{ $review->created_at->format('d/m/Y') }}
			<div>
				{{ $review->content }}
			</div>
			Was this review helpful?
			<a href="" class="upvote">Yes</a> / <a href="" class="downvote">No</a> {{ $review->totalVotes() }}
			<hr>
			@endforeach
		</div>
	</div>
</div>
@stop

@section('scripts')
<script>
	$('.upvote').click(function(){
		console.log($(this).data('value'));
		$.ajax('votes/create', {
			type: "POST",
			data: {
				vote: 1,
				post: $(this).data('value'),
				_token: "{{ csrf_token() }}"
			}
		}).fail(function(e) {
			console.log(e.responseText);
		}).done(function(response) {
			console.log(response, 'response');
			$('#' + response[1]).html(response[0]);
			$('.up-' + response[1]).addClass('upmod');
			$('.score-' + response[1]).addClass('likes');
			$('.down-' + response[1]).removeClass('downmod');
			$('.score-' + response[1]).removeClass('dislikes');
		});
	});

	$('.downvote').click(function(){
		console.log($(this).data('value'));
		$.ajax('votes/create', {
			type: "POST",
			data: {
				vote: 0,
				post: $(this).data('value'),
			  _token: "{{ csrf_token() }}"
			} 
		}).done(function(response) {
			console.log(response, 'response');
			$('#' + response[1]).html(response[0]);
			$('.down-' + response[1]).addClass('downmod');
			$('.score-' + response[1]).addClass('dislikes');
			$('.up-' + response[1]).removeClass('upmod');
			$('.score-' + response[1]).removeClass('likes');
		});
	});
</script>
@stop