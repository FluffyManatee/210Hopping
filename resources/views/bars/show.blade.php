@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row" id="bar-info">
		<div class="col-xs-6" id="details">
		</div>
		<div class="col-xs-6" id="photos">
		</div>
	</div>
	<div class="row" id="bar-reviews">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#specials" aria-controls="specials" role="tab" data-toggle="tab">Specials</a></li>
				<li role="presentation"><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Reviews</a></li>
				<li role="presentation"><a href="#popular-drinks" aria-controls="popular-drinks" role="tab" data-toggle="tab">Popular Drinks</a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade in active" id="specials">...</div>
				<div role="tabpanel" class="tab-pane fade" id="reviews">...</div>
				<div role="tabpanel" class="tab-pane fade" id="popular-drinks">...</div>
		</div>
	</div>
</div>
@section('scripts')
<script>
	$('#myTabs a:first').tab('show')
	$('#myTabs a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	})
</script>
@stop