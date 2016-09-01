@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row" id="bar-info">
		<div class="col-xs-6" id="details">
			<h3>{{ $bar->name }}</h3>
			avg rating here
			<br>
			avg price here
			<br>
			{{ $bar->address }}
			<br>
			{{ $bar->phone }}
			<br>
			<a href="{{ $bar->website }}">Website</a>
		</div>
		<div class="col-xs-6" id="photos">
			<div id="carousel" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					@foreach ($bar->pictures as $picture)
					<li data-target="#carousel" data-slide-to="0" class=""></li>
					@endforeach
				</ol>
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					@foreach ($bar->pictures as $index => $picture)
					<div class="item @if($index == 0) {{ 'active' }} @endif">
						<img style="width: 90%; height: 40vh;" src="{{ $picture->pic_url }}" alt="...">
						<div class="carousel-caption">
							<!-- maybe add captions to pictures table? -->
						</div>
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
	<hr>
	<!-- bottom portion -->
	@if (Auth::check())
	<a class="btn btn-default" href="/reviews/create?bar_id={{ $bar->id }}">Write a Review</a>
	<button id="image-upload" type="button" class="btn btn-default">Upload an image</button>
	@endif
	<div id="dropzone">
		<form action="{{ action('PicturesController@store', $bar->id) }}" method="POST" enctype="multipart/form-data" class="dropzone">
			{{ csrf_field() }}
		</form>
	</div>
	<div class="row" id="bar-reviews">
		<div class="col-xs-12">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" id="myTabs" role="tablist">
				<li role="presentation" class="active"><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Reviews</a></li>
				<li role="presentation" class=""><a href="#specials" aria-controls="specials" role="tab" data-toggle="tab">Specials</a></li>
				<li role="presentation" class=""><a href="#bar-features" aria-controls="bar-features" role="tab" data-toggle="tab">Features</a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade in active" id="reviews">
					@foreach ($bar->reviews as $review)
					<div class="row">
						<div class="col-xs-3">
							<img src="{{ $review->user->avatar }}" class="thumbnail responsive" height="60" width="60">
							<h5>{{ $review->user->first_name }} {{ $review->user->last_name }}</h5>
							<br>
							user score
							<br>
							helpful?
						</div>
						<div class="col-xs-9">
							<h4>{{ $review->title }} <small>posted {{ $review->created_at->diffForHumans() }}</small></h4>
							<p><h4>{{ $review->beerRating() }}</h4></p>
							<p>{{ $review->content }}</p>
						</div>
					</div>
					@endforeach
				</div>
				<div role="tabpanel" class="tab-pane fade" id="specials">test</div>
				<div role="tabpanel" class="tab-pane fade" id="bar-features">
					@foreach ($bar->features as $feature)
					{!! $feature->featureIcons() !!}
					@endforeach
				</div>
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
		interval: 2000
	});
	$('#image-upload').click(function() {
		$('#dropzone').slideToggle('slow');
	});
</script>
@stop