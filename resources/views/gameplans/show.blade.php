@extends('layouts.master')
@section('content')
    {{--{{dd($gameplan->bars)}}--}}
    <div class="container">
        <h1><a href="{{ action('GameplansController@show', $gameplan->id) }}">Gameplan #{{ $gameplan->id }}</a></h1>
        {{--<h2>{{ $gameplan->date()->format('l, F jS Y') }}</h2>--}}
        @foreach($gameplan->bars as $gpbar)
        <h2>{{ $gpbar->bar->name }}</h2>
        <div class="row">
            <div class="col-xs-6 col-md-3">
                <a href="{{ $gpbar->bar->pictures->first()->pic_url }}" class="thumbnail">
                    <img src="{{ $gpbar->bar->pictures->first()->pic_url }}">
                </a>
            </div>
        </div>
        @endforeach
        {{--{{ dd($gameplan->hoppers()->first()->user->first_name) }}--}}
        @foreach($gameplan->hoppers as $hopper)
            <h3>Hoppers:</h3>
            <h5>{{ $hopper->user->first_name }}</h5>
        @endforeach
        <h3>Submitted by:</h3>
        <h5>{{ $gameplan->author->first_name }} {{ $gameplan->author->last_name }}</h5>
        <a href="addHopper/{{ $gameplan->id }}"><h5>Join Gameplan</h5></a>

        @if((Auth::user()) && (Auth::user()->id == $gameplan->author_id))
            {{--<div>--}}
                {{--<a class="btn btn-success" href="{{action('EventsController@edit', $event->id) }}">Edit Event</a>--}}
                {{--<form method="POST" action="{{action('EventsController@destroy', $event->id) }}">--}}
                    {{--<input type="submit" class="btn btn-danger" value="Delete Event">--}}
                    {{--{{ method_field('DELETE') }}--}}
                    {{--{{ csrf_field() }}--}}
                {{--</form>--}}
            {{--</div>--}}
        @endif
        {{--<small><a class="btn btn-info" href="{{ action('EventsController@index') }}">Return to events</a></small>--}}
    </div>
@stop