@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-xs-8 col-xs-offset-2">
		<h4 class="modal-title">write a review</h4>
		<form method="POST" action="{{ action('ReviewsController@store') }}">
			{{ csrf_field() }}
			<input hidden name="bar_id" value="{{$id}}">
			<div class="form-group">
				<input type="text" class="form-control" name="title" id="title" placeholder="title">
				@include('forms.error', ['field' => 'title'])
			</div>
			<div class="form-group">
				<textarea rows="4" class="form-control" name="content" id="content" placeholder="content"></textarea>
				@include('forms.error', ['field' => 'content'])
			</div>
			<div class="star-rating">
				<fieldset class="rating">
					<input type="radio" id="star5" name="beer_rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
					<input type="radio" id="star4half" name="beer_rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
					<input type="radio" id="star4" name="beer_rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
					<input type="radio" id="star3half" name="beer_rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
					<input type="radio" id="star3" name="beer_rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
					<input type="radio" id="star2half" name="beer_rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
					<input type="radio" id="star2" name="beer_rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
					<input type="radio" id="star1half" name="beer_rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
					<input type="radio" id="star1" name="beer_rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
					<input type="radio" id="starhalf" name="beer_rating" value=".5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
				</fieldset>
			</div>
			<button type="submit" class ="btn btn-primary pull-right">POST</button>
		</form>
	</div>
</div>
@stop