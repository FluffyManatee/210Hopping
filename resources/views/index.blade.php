@extends('layouts.master')

@section('content')
<div class="container content">
	<div class="row">
		<h1>{{ Carbon\Carbon::now('America/Chicago')->formatLocalized('%A') }}  <small>{{ Carbon\Carbon::now('America/Chicago')->formatLocalized('%B %d, %Y') }}</small></h1>
	</div>
</div>
<script>
	window.onload = function() {
		var startPos;
		var lat;
		var lon;
		var latLongObject;
		var geoOptions = {
			timeout: 10 * 1000,
			maximumAge: 5 * 60 * 1000
		}
		var geoSuccess = function(position) {
			startPos = position;
			document.getElementById('startLat').innerHTML = startPos.coords.latitude;
			document.getElementById('startLon').innerHTML = startPos.coords.longitude;
			lat = startPos.coords.latitude;
			lon = startPos.coords.longitude;
			latLongObject = new google.maps.LatLng(lat,lon);
		};

		var geoError = function(error) {
			console.log('Error occurred. Error code: ' + error.code);
			// error.code can be:
			//   0: unknown error
			//   1: permission denied
			//   2: position unavailable (error response from location provider)
			//   3: timed out
		};
		navigator.geolocation.getCurrentPosition(geoSuccess, geoError, geoOptions);
	};
</script>
@stop