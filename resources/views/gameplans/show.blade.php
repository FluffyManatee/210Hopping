@extends('layouts.master')
@section('content')
    {{--{{dd($gameplan->bars)}}--}}
    <div class="container">
        {{--<h1><a href="{{ action('GameplansController@show', $gameplan->id) }}">Gameplan #{{ $gameplan->id }}</a></h1>--}}
        {{--code above is awesome this is the wrong place for it--}}
        <h3>Gameplan for {{ $gameplan->date->format('Y-m-d') }}</h3>
        <h4>Time: {{ $gameplan->time->format('H:iA') }}</h4>
        <h4>Head Hopper: {{ $gameplan->author->first_name . ' ' . $gameplan->author->formatLastName() }}.</h4>
        {{--<h5></h5>--}}
        {{--<h2>{{ $gameplan->date()->format('l, F jS Y') }}</h2>--}}
        <h4>Hop-Stops:</h4>
        @foreach($gameplan->bars as $gpbar)
        <a href="/bars/{{ $gpbar->bar->id }}"><h5>{{ $gpbar->bar->name }}</h5></a>
        <div class="row">
            {{--<div class="col-xs-6 col-md-3">--}}
                {{--<a href="{{ $gpbar->bar->pictures->first()->pic_url or '' }}" class="thumbnail">--}}
                    {{--<img src="{{ $gpbar->bar->pictures->first()->pic_url or '' }}">--}}
                {{--</a>--}}
            {{--</div>--}}
        </div>
        @endforeach
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2" id="photos">
                <div id="carousel" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner carousel-image-container events-slider" role="listbox">
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
        {{--{{ dd($gameplan->hoppers()->first()->user->first_name) }}--}}
        <h4>Hoppers:</h4>
        @foreach($gameplan->hoppers as $hopper)
            <h5>{{ $hopper->user->first_name . ' ' . $hopper->user->formatLastName() }}.</h5>
        @endforeach
        @if(Auth::check())
            @if(Auth::user()->id != $gameplan->author->id)
            <div>
                <a class="btn btn-warning" href="addHopper/{{ $gameplan->id }}">Join Gameplan</a>
            </div>
            @endif
        @endif
        @if(Auth::check())
            @if((Auth::user()) && (Auth::user()->id == $gameplan->author_id))
                <div>
                    <a class="btn btn-success" href="{{action('GameplansController@edit', $gameplan->id) }}">Edit Gameplan</a>
                    <form method="POST" action="{{action('GameplansController@destroy', $gameplan->id) }}">
                        <input type="submit" class="btn btn-danger" value="Delete Event">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                </div>
            @endif
        @endif
        {{--<small><a class="btn btn-info" href="{{ action('EventsController@index') }}">Return to events</a></small>--}}
    </div>
@stop