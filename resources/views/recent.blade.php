@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row" id="bar-reviews">
		<div class="col-xs-12">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" id="myTabs" role="tablist">
				<li role="presentation" class="active"><a href="#reviews" aria-controls="reviews" role="tab"
					data-toggle="tab">Bars</a></li>
					<li role="presentation" class=""><a href="#events" aria-controls="specials" role="tab"
						data-toggle="tab">Events</a></li>
						<li role="presentation" class=""><a href="#specials" aria-controls="events" role="tab"
							data-toggle="tab">Specials</a></li>
							<li role="presentation" class=""><a href="#gameplans" aria-controls="events" role="tab"
								data-toggle="tab">Gameplans</a></li>
							</ul>
							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane fade in active" id="reviews">
									@foreach ($recent['bars'] as $bar)
									<div data-value="{{ $bar->id }}" class="row thisBar">
										<div class="col-xs-2">
											<img src="{{ $bar->pictures()->first()->pic_url or "" }}" class="thumbnail responsive"
											height="100" width="100">
										</div>
										<div class="col-xs-9">
											<h2>{{ $bar->name}}</h2>
											<p>
												<a href="http://maps.apple.com/?q={{ $bar->address }}"><strong>{{ $bar->address}}</strong></a>
												| <a href="tel:{{ $bar->phone }}">{{ $bar->formatPhoneNumber() }}</a></p>
												@if ($bar->averageBarRating() != null)
												<p class="beer-rating">{!! $bar->averageBarRating() !!}</p>
												&nbsp; {{ count($bar->reviews) }} reviews
												@else
												no ratings yet
												@endif
											</div>
										</div>
										<hr>
										@endforeach
									</div>
									<div role="tabpanel" class="tab-pane fade" id="events">
										@foreach ($recent['events'] as $event)
										<div data-value="" class="row">
											<div class="col-xs-2">
												<img src="{{ $event->event_pic or "" }}" class="thumbnail responsive" height="100"
												width="100">
											</div>
											<div class="col-xs-9">
												<a href="/events/{{ $event->id }}"><h2>{{ $event->title}}</h2></a>
												<p>Where: <a href="/bars/{{ $event->bar->id }}">{{ $event->bar->name}}</a></p>
												<p>When: {{ $event->date }}</p>
												<p>{{ $event->time }}</p>
											</div>
										</div>
										<hr>
										@endforeach
									</div>
									<div role="tabpanel" class="tab-pane fade" id="specials">
										@foreach ($recent['specials'] as $special)
										<div data-value="" class="row">
											<div class="col-xs-2">
												<img src="" class="thumbnail responsive" height="100" width="100">
											</div>
											<div class="col-xs-9">
												<a href="/specials/{{ $special->id }}"><h2>{{ $special->title}}</h2></a>
												<p>Where: <a href="/bars/{{ $special->bar->id }}">{{ $special->bar->name}}</a></p>
											</div>
										</div>
										<hr>
										@endforeach
									</div>
									<div role="tabpanel" class="tab-pane fade" id="gameplans">
										@foreach($recent['gameplans'] as $gameplan)
										<div class="row">
											<table class="table table-condensed col-xs-12">
												<h3><a href="{{ action('GameplansController@show', $gameplan->id) }}">Gameplan
													for {{ $gameplan->date }}</a></h3>
													<h4>Hop-Stops:</h4>
													<div class="row">
														<div class="col-xs-8 col-xs-offset-2" id="photos">
															<div id="carousel" class="carousel slide" data-ride="carousel">
																<!-- Wrapper for slides -->
																<div class="carousel-inner carousel-image-container events-slider"
																role="listbox">
																@foreach($gameplan->bars as $index => $gpbar)
																<div data-value="{{ $gpbar->bar->id }}"
																	class="item @if($index == 0) {{ 'active' }} @endif">
																	<div class="carousel-caption">
																		<h2>{{ $gpbar->bar->name }}</h2>
																		<p>{{ $index+1 }}</p>
																	</div>
																	<img class="cover"
																	src="{{ $gpbar->bar->pictures->first()->pic_url or '' }}"
																	alt="{{ $gpbar->bar->name }}">
																</div>
																@endforeach
															</div>
															<!-- Controls -->
															<a class="left carousel-control" href="#carousel" role="button"
															data-slide="prev">
															<span class="glyphicon glyphicon-chevron-left"
															aria-hidden="true"></span>
															<span class="sr-only">Previous</span>
														</a>
														<a class="right carousel-control" href="#carousel" role="button"
														data-slide="next">
														<span class="glyphicon glyphicon-chevron-right"
														aria-hidden="true"></span>
														<span class="sr-only">Next</span>
													</a>
												</div>
											</div>
										</div>
										<h4>Hoppers:</h4>
										@foreach($gameplan->hoppers as $hopper)
										<h5>{{ $hopper->user->first_name . ' ' . $hopper->user->formatLastName() }}</h5>
										@endforeach
										@if((Auth::user()) && (Auth::user()->id == $gameplan->author_id))
										<div>
											<a class="btn btn-success"
											href="{{action('GameplansController@edit', $gameplan->id) }}">Edit
											Gameplan</a>
											<form method="POST"
											action="{{action('GameplansController@destroy', $gameplan->id) }}">
											<input type="submit" class="btn btn-danger" value="Delete Event">
											{{ method_field('DELETE') }}
											{{ csrf_field() }}
										</form>
									</div>
									@endif
								</table>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
		@stop
