@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-xs-8 col-xs-offset-2">
		<h4 class="modal-title">create a bar</h4>
		<form method="POST" action="{{ action('Auth\AuthController@postLogin') }}">
			{{ csrf_field() }}
			<div class="form-group">
				<input type="text" class="form-control" name="name" id="name" placeholder="bar name">
				@include('forms.error', ['field' => 'name'])
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="address" id="address" placeholder="bar address">
				@include('forms.error', ['field' => 'address'])
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="phone" id="phone" placeholder="phone number">
				@include('forms.error', ['field' => 'phone'])
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="website" id="website" placeholder="bar website">
				@include('forms.error', ['field' => 'website'])
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="email" id="email" placeholder="bar email">
				@include('forms.error', ['field' => 'email'])
			</div>
			<select name="type" id="type">
				<option value="">bar type...</option>
				<option value="pub">Pub</option>
				<option value="dive">Dive</option>
				<option value="club">Club</option>
				<option value="sports">Sports</option>
				<option value="karaoke">Karaoke</option>
				<option value="rock">Rock</option>
				<option value="jazz">Jazz</option>
				<option value="taproom">Taproom</option>
				<option value="cocktail">Cocktail</option>
			</select>
			<button type="submit" class ="btn btn-primary pull-right">CREATE</button>
		</form>
	</div>
</div>
@stop