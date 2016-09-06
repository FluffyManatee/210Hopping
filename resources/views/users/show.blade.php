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
		<div class="col-xs-9">
			<h3>Reviews</h3>
			<hr>
			@foreach ($user->reviews as $review)
			<div class="row">
				<div class="col-xs-2">
					<img src="" class="thumbnail responsive" height="65" width="65">
				</div>
				<div class="col-xs-10">
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
			<div role="button" data-value="{{ $review->id }}" class="upvote">Yes</div> / <div role="button" data-value="{{ $review->id }}" class="downvote">No</div> 
			<div id="{{ $review->id }}">{{ $review->totalVotes() }}</div>
			<hr>
			@endforeach
		</div>
	</div>
</div>
@stop
@include('partials.vote-ajax')
