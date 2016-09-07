@extends('layouts.master')
@section('content')
    {{--{{dd($gameplan->bars)}}--}}
    <div class="container">
        {{--<h1><a href="{{ action('GameplansController@show', $gameplan->id) }}">Gameplan #{{ $gameplan->id }}</a></h1>--}}
        {{--code above is awesome this is the wrong place for it--}}
        <h3>Gameplan for {{ $gameplan->date }}</h3>
        <h4>Head Hopper:</h4>
        <h5>{{ $gameplan->author->first_name . ' ' . $gameplan->author->formatLastName() }}</h5>
        <a href="addHopper/{{ $gameplan->id }}"><h5>Join Gameplan</h5></a>
        {{--<h2>{{ $gameplan->date()->format('l, F jS Y') }}</h2>--}}
        @foreach($gameplan->bars as $gpbar)
        <h3>{{ $gpbar->bar->name }}</h3>
        <div class="row">
            <div class="col-xs-6 col-md-3">
                <a href="{{ $gpbar->bar->pictures->first()->pic_url }}" class="thumbnail">
                    <img src="{{ $gpbar->bar->pictures->first()->pic_url }}">
                </a>
            </div>
        </div>
        @endforeach
        {{--{{ dd($gameplan->hoppers()->first()->user->first_name) }}--}}
        <h4>Hoppers:</h4>
        @foreach($gameplan->hoppers as $hopper)
            <h5>{{ $hopper->user->first_name . ' ' . $hopper->user->formatLastName() }}</h5>
        @endforeach
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
        {{--<small><a class="btn btn-info" href="{{ action('EventsController@index') }}">Return to events</a></small>--}}
    </div>
@stop