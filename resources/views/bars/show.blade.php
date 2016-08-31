@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row" id="bar-info">
		<div class="col-xs-6" id="details">
			<h3>{{ $bar->name }}</h3>
			avg rating here
			<br>
			avg price here
		</div>
		<div class="col-xs-6" id="photos">
			<div id="carousel" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#carousel" data-slide-to="0" class="active"></li>
					<li data-target="#carousel" data-slide-to="1"></li>
					<li data-target="#carousel" data-slide-to="2"></li>
				</ol>
				<!-- Wrapper for slides -->
				@foreach ($bar->pictures as $picture)
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<img src="$picture->pic_url" alt="...">
						<div class="carousel-caption">
							...
						</div>
					</div>
				</div>
				@endforeach
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
	<div class="row" id="bar-reviews">
		<div class="col-xs-12">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" id="myTabs" role="tablist">
				<li role="presentation" class="active"><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Reviews</a></li>
				<li role="presentation" class=""><a href="#specials" aria-controls="specials" role="tab" data-toggle="tab">Specials</a></li>
				<li role="presentation" class=""><a href="#popular-drinks" aria-controls="popular-drinks" role="tab" data-toggle="tab">Popular Drinks</a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade in active" id="reviews">
					@foreach ($bar->reviews as $review)
					<div class="row">
						<div class="col-xs-3">
							
						</div>
						<div class="col-xs-9">
							<h4>{{ $review->title }}</h4>
							{{ $review->content }}
							{{ $review->beer_rating }}
						</div>
					</div>
					@endforeach
				</div>
				<div role="tabpanel" class="tab-pane fade" id="specials">test</div>
				<div role="tabpanel" class="tab-pane fade" id="popular-drinks">...</div>
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
</script>
@stop