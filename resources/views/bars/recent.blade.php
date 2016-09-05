@extends('layouts.master')

@section('content')
        <div class="row" id="bar-reviews">
            <div class="col-xs-12">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                    <li role="presentation" class="active"><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Bars</a></li>
                    <li role="presentation" class=""><a href="#events" aria-controls="specials" role="tab" data-toggle="tab">Events</a></li>
                    <li role="presentation" class=""><a href="#specials" aria-controls="events" role="tab" data-toggle="tab">Specials</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="reviews">
                        @foreach($recent['bars'] as $bar)
                            <div class="row">
                                <div class="col-xs-3">
                                    <img src="{{ $bar->pictures()->first()->pic_url}}" class="thumbnail responsive" height="60"
                                         width="60">
                                    <h3>{{ $bar->name }}</h3>
                                    <h5>{{ $bar->address }}</h5>
                                    <h5>{{ $bar->type }}</h5>
                                    <a href="/bars/{{ $bar->id }}">barpage</a>
                                </div>
                                <div class="col-xs-9">
                                    <h4>
                                        <small>posted {{ $bar->created_at->diffForHumans() }}</small>
                                    </h4>
                                    <p class="beer-rating">{!! $bar->averageBarRating() !!}</p>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="events">
                        @foreach($recent['events'] as $event)
                            <div class="row">
                                <h2>{{ $event->title }}</h2>
                                <a href="/events/{{ $event->id }}">eventpage</a>
                                {{--<div class="col-xs-3">--}}
                                {{--<img src="{{ $review->user->avatar }}" class="thumbnail responsive" height="60" width="60">--}}
                                {{--<h5>{{ $review->user->first_name }} {{ $review->user->last_name }}</h5>--}}
                                {{--user score--}}
                                {{--<br>--}}
                                {{--helpful?--}}
                                {{--</div>--}}
                                {{--<div class="col-xs-9">--}}
                                {{--<h4>{{ $review->title }} <br><small>posted {{ $review->created_at->diffForHumans() }}</small></h4>--}}
                                {{--<p class="beer-rating">{!! $review->beerRating() !!}</p>--}}
                                {{--<p>{{ $review->content }}</p>--}}
                                {{--</div>--}}
                            </div>
                            <hr>
                        @endforeach
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="specials">
                        @foreach($recent['specials'] as $special)
                            <div class="row">
                                <div class="col-xs-3">
                                    <h1>{{$special->title}}</h1>
                                    <a href="/specials/{{ $special->id }}">specialpage</a>
                                    {{--<img src="{{ $review->user->avatar }}" class="thumbnail responsive" height="60" width="60">--}}
                                    {{--<h5>{{ $review->user->first_name }} {{ $review->user->last_name }}</h5>--}}
                                    {{--user score--}}
                                    {{--<br>--}}
                                    {{--helpful?--}}
                                    {{--</div>--}}
                                    {{--<div class="col-xs-9">--}}
                                    {{--<h4>{{ $review->title }} <br><small>posted {{ $review->created_at->diffForHumans() }}</small></h4>--}}
                                    {{--<p class="beer-rating">{!! $review->beerRating() !!}</p>--}}
                                    {{--<p>{{ $review->content }}</p>--}}
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
@stop