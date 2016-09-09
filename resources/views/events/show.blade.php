@extends('layouts.master')

@section('content')
<div class="container">
    <h1><a href="{{ action('BarsController@show', $event->bar->id) }}"> {{ $event->bar->name }}</a></h1>
    <h2>{{ $event->date->format('l, F jS Y h:iA') }}</h2>
    <h2>{{ $event->title }}</h2>
    <div class="row">
        <div class="col-xs-6 col-md-3">
            <a href="{{ $event->event_pic }}" class="thumbnail">
                <img src="{{$event->event_pic}}">
            </a>
        </div>
    </div>
    {{ $event->content }}
    <h3>Submitted by:</h3>
    <h5><a href="{{ action('UserController@show', $event->user->id) }}"> {{ $event->user->first_name }} {{ $event->user->formatLastName() }}.</a></h5>

@if((Auth::user()) && (Auth::user()->id == $event->created_by))
    <div>
        <a class="btn btn-success" href="{{action('EventsController@edit', $event->id) }}">Edit Event</a>
        <form method="POST" action="{{action('EventsController@destroy', $event->id) }}">
            <input type="submit" class="btn btn-danger" value="Delete Event">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
        </form>
    </div>
@endif
    <small><a class="btn btn-info" href="{{ action('EventsController@index') }}">Go to events</a></small>
</div>
@stop