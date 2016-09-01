@extends('layouts.master')

@section('content')
<div class="container">
    <h1><a href="{{ action('BarsController@show', $event->bar->id) }}"> {{ $event->bar->name }}</a></h1>
    <h2>{{ $event->date->format('l, F jS Y') }}</h2>
    <h2>{{ $event->title }}</h2>
    <h5><img src="{{$event->event_pic}}"></h5>
    {{ $event->content }}
    <h3>Submitted by:</h3>
    <h5>{{ $event->user->first_name }} {{ $event->user->last_name }}</h5>

@if(Auth::user()->id == $event->created_by)
    <div>
        <a class="btn btn-success" href="{{action('EventsController@edit', $event->id) }}">Edit Post</a>
        <form method="POST" action="{{action('EventsController@destroy', $event->id) }}">
            <input type="submit" class="btn btn-danger" value="Delete">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
        </form>
    </div>
@endif
    <small><a class="btn btn-info" href="{{ action('EventsController@index') }}">Return to events</a></small>
</div>
@stop