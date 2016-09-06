@extends('layouts.master')

@section('content')
<div class="container content">
	<div class="row">
		<h1>{{ Carbon\Carbon::now('America/Chicago')->formatLocalized('%A') }}  <small>{{ Carbon\Carbon::now('America/Chicago')->formatLocalized('%B %d, %Y') }}</small></h1>
		<textarea type="text" id="startLat"></textarea>
		<textarea type="text" id="startLon"></textarea>
	</div>
</div>
@stop