@extends('layouts.master')

@section('content')
        <div class="container">
            <div class="row">
                <table class="table table-condensed">
                    @foreach($events as $event)
                        <div></div>
                        <tr>
                            <td>{{ $event->title }}<br>{{ $event->date }}</td>
                            <td>{{ $post->content }}</td>
                            <td><strong>By:</strong> {{ $event->user->name}}<br><strong>On:</strong> {{ $event->created_at}}<br> <strong>Updated on:</strong> {{$event->updated_at}}</td>
                            <td><a href="{{action('EventsController@show', $event->id)}}">See Event</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
{{--{!! $events->render() !!}--}}
@stop