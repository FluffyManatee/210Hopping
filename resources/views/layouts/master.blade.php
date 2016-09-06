<!DOCTYPE html>
<html lang="en">
<head>
	<title>210hopping - </title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Master CSS -->
	<link rel="stylesheet" href="/css/master.css">
	<!-- Dropzone.js -->
	<script src="/js/dropzone.js"></script>
	<link rel="stylesheet" href="/css/dropzone.css">
	<link rel="stylesheet" href="/css/basic.css">
	<!-- FontAwesome -->
	<script src="https://use.fontawesome.com/2bcd30c787.js"></script>
</head>
<body>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Header -->
	@include('partials.header')
	<!-- end Header -->
	@if (session()->has('SUCCESS_MESSAGE'))
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{ session('SUCCESS_MESSAGE') }}
	</div>
	@endif
	@if (session()->has('ERROR_MESSAGE'))
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{ session('ERROR_MESSAGE') }}
	</div>
	@endif
	<!-- views will appear here --> 
	@yield('content')
	<!-- bottom navigation -->
	<div class="bottom-nav-spacer">
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="btn-group btn-group-justified navigation" id="bottom" role="group" aria-label="navigation">
				<a href="" id="nearby" class="btn btn-default nav-nearby" role="group" aria-label="nearby">
					<i class="fa fa-location-arrow fa-2x" aria-hidden="true"></i>
					<br>
					Nearby
				</a>
				<a href="" class="btn btn-default nav-search search" role="group" aria-label="search">
					<i class="fa fa-search fa-2x" aria-hidden="true"></i>
					<br>
					Search
				</a>
				<a href="/" class="btn btn-default nav-home" role="group" aria-label="home">
					<i class="fa fa-home fa-4x" aria-hidden="true"></i>
					<br>
					Home
				</a>
				<a href="/recent" class="btn btn-default nav-activity" role="group" aria-label="activity">
					<i class="fa fa-bolt fa-2x" aria-hidden="true"></i>
					<br>
					Activity
				</a>
				<a href="" id="more" class="btn btn-default nav-more" role="group" aria-label="more">
					<i class="fa fa-bars fa-2x" aria-hidden="true"></i>
					<br>
					More
				</a>
			</div>


		</div>
		<div class="row">
			<div style="height: 90px; margin-bottom: 90px; background-color: papayawhip;" role="group" class="hidden navbar-fixed-bottom btn-group btn-group-justified navigation" id="more-select">
				<a href="" id="nearby" class="btn btn-default nav-nearby" role="group" aria-label="nearby">
					<i class="fa fa-location-arrow fa-2x" aria-hidden="true"></i>
					<br>
					User
				</a>
				<a href="" class="btn btn-default nav-search search" role="group" aria-label="search">
					<i class="fa fa-search fa-2x" aria-hidden="true"></i>
					<br>
					Search
				</a>
				<a href="/" class="btn btn-default nav-home" role="group" aria-label="home">
					<i class="fa fa-home fa-4x" aria-hidden="true"></i>
					<br>
					Home
				</a>
				<a href="/recent" class="btn btn-default nav-activity" role="group" aria-label="activity">
					<i class="fa fa-bolt fa-2x" aria-hidden="true"></i>
					<br>
					Activity
				</a>
				<a href="" id="exit" class="btn btn-default nav-more" role="group" aria-label="more">
					<i class="fa fa-bars fa-2x" aria-hidden="true"></i>
					<br>
					More
				</a>

			</div>
		</div>
	</div>
	<!-- Latest compiled and minified BS JavaScript -->
	<script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	@yield('scripts')
	<script>
		window.onload = function() {
			var startPos;
			var lat;
			var lon;
//		var latLongObject;
			var geoOptions = {
				timeout: 10 * 1000,
				maximumAge: 5 * 60 * 1000
			}
			var geoSuccess = function(position) {
				startPos = position;
//				document.getElementById('startLat').innerHTML = startPos.coords.latitude;
//				document.getElementById('startLon').innerHTML = startPos.coords.longitude;
				lat = startPos.coords.latitude;
				lon = startPos.coords.longitude;
				console.log(lat, lon);
				$('#nearby').attr('href', '/nearby/' + lat + '/' + lon);
//			latLongObject = new google.maps.LatLng(lat,lon);
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
	<script type="text/javascript">
		{{-- search button toggle--}}
		$('.search').click(function(e){
			e.preventDefault();
			$('.search-form').slideToggle('slow');
		});
		{{-- filter button toggle--}}
		$('.filter').click(function(){
			$('.features-select').slideToggle('slow').removeClass('hidden');
		});


	</script>
	<script type="text/javascript">
		{{-- more button toggle--}}
		$('#more').click(function(e){
			e.preventDefault();
			$('#more-select').slideToggle('slow').removeClass('hidden');
		});
		{{-- exit button toggle--}}
        $('#exit').click(function(e){
			e.preventDefault();
			$('#more-select').slideToggle('slow').addClass('hidden');
		});

	</script>
	<script>

	$("#form").submit(function (e) {
			var features = [];
			var featuresInput = $('#features');
			$('input[type="checkbox"]:checked').each(function (index, element) {
				features.push($(element).val());
			});
			featuresInput.val(features);
		});

	</script>
	</body>
	</html>