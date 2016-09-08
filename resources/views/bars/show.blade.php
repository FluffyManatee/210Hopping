@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row" id="bar-info">
            <div class="col-xs-6" id="details">
                <h3>{{ $bar->name }}</h3>
                <p class="beer-rating">{{ $bar->averageBarRating() }}</p>
                <br>
                avg price here
                <br>
                <a href="http://maps.apple.com/?q={{ $bar->address }}">{{ $bar->address }}</a>
                <br>
                <a href="tel:{{$bar->phone}}">{{ $bar->formatPhoneNumber() }}</a>
                <br>
                <a href="{{ $bar->website }}">Website</a>
                <br>
                @if(Auth::check())
                    <a class="btn btn-default" href="{{ action('BarsController@edit', $bar->id) }}">Edit bar info</a>
                    <button style="margin-left: auto; margin-right: auto" id="image-upload" type="button" class="btn btn-default">Upload an image</button>
                @endif
            </div>
            <div class="col-xs-6" id="photos">
                <div id="carousel" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner carousel-image-container" role="listbox">
                        @foreach ($bar->pictures as $index => $picture)
                            <div class="item @if($index == 0) {{ 'active' }} @endif">
                                <img class="cover" src="{{ $picture->pic_url }}" alt="...">
                                <div class="carousel-caption">
                                    <!-- maybe add captions to pictures table? -->
                                </div>
                            </div>
                        @endforeach
                    </div>
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
        @if (Auth::check())
            <a class="btn btn-default" href="/reviews/create?bar_id={{ $bar->id }}">Write a Review</a>

            <div id="dropzone">
                <form action="{{ action('PicturesController@store', $bar->id) }}" method="POST"
                      enctype="multipart/form-data" class="dropzone">
                    {{ csrf_field() }}
                </form>
            </div>
            <a class="btn btn-default" href="/specials/create?bar_id={{ $bar->id }}">Add a special</a>
            <a class="btn btn-default" href="/events/create?bar_id={{ $bar->id }}">Add an event</a>
        @endif
        <div class="row" id="bar-reviews">
            <div class="col-xs-12">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                    <li role="presentation" class="active"><a href="#reviews" aria-controls="reviews" role="tab"
                                                              data-toggle="tab">Reviews</a></li>
                    <li role="presentation" class=""><a href="#specials" aria-controls="specials" role="tab"
                                                        data-toggle="tab">Specials</a></li>
                    <li role="presentation" class=""><a href="#bar-features" aria-controls="bar-features" role="tab"
                                                        data-toggle="tab">Features</a></li>
                    <li role="presentation" class=""><a href="#events" aria-controls="events" role="tab"
                                                        data-toggle="tab">Events</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="reviews">
                        @foreach ($bar->reviews as $review)
                            <div class="row">
                                <div class="col-xs-3">
                                    <img src="{{ $review->user->avatar }}" class="thumbnail responsive" height="60"
                                         width="60">
                                    <h5>
                                        <a href="{{ action('UserController@show', $review->user->id) }}">{{ $review->user->first_name }} {{ $review->user->last_name }}</a>
                                    </h5>
                                    user score
                                    <br>
                                    helpful?
                                </div>
                                <div class="col-xs-9">
                                    <h4>{{ $review->title }} <br>
                                        <small>posted {{ $review->created_at->diffForHumans() }}</small>
                                    </h4>
                                    <p class="beer-rating">{!! $review->beerRating() !!}</p>
                                    <p>{{ $review->content }}</p>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="specials">
                        {{--@if(Auth::user())--}}
                            {{--<a href="/specials/create?bar_id={{ $bar->id }}">Add a special...</a>--}}
                        {{--@endif--}}
                        @foreach ($bar->specials as $special)
                            <div class="row">
                                <div class="col-xs-3">
                                    <h5>
                                        <a href="{{ action('SpecialsController@show', $special->id) }}">{{ $special->title }}</a>
                                    </h5>
                                </div>
                                <div class="col-xs-9">
                                    <p>{{ $special->content }}</p>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="bar-features">
                        @foreach ($bar->features as $feature)
                            {!! $feature->featureIcons() !!}
                        @endforeach
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="events">
                        {{--@if(Auth::user())--}}
                            {{--<a href="/events/create?bar_id={{ $bar->id }}">Add an event...</a>--}}
                        {{--@endif--}}
                        @foreach ($bar->events as $event)
                            <div class="row">
                                <img src="{{ $event->event_pic }}" class="thumbnail responsive col-xs-2" height="60"
                                     width="60">
                                <div class="col-xs-3">
                                    <h5>
                                        <a href="{{ action('EventsController@show', $event->id) }}">{{ $event->title }}</a>
                                    </h5>
                                </div>
                                <div class="col-xs-7">
                                    <p>{{ $event->content }}</p>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
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
            interval: 4000
        });
        $('#image-upload').click(function () {
            $('#dropzone').slideToggle('slow');
        });
    </script>
    @include('partials.vote-ajax')
@stop