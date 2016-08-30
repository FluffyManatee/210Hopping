@extends('layouts.master')

@section('content')
<div class="container content">
	<div class="row">
		<div class="page-header">
		<h1>{{ Carbon\Carbon::now('America/Chicago')->formatLocalized('%A') }}<small>{{ Carbon\Carbon::now('America/Chicago')->formatLocalized('%B %d, %Y') }}</small></h1>
		</div>
	</div>
</div>
@stop