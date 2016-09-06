@extends('layouts.master')

@section('content')
        <div class="container">
            <div class="row">
                <table class="table table-condensed col-xs-12">
                    @foreach($events as $event)
                        <div></div>
                        <tr>
                            <td>{{ $event->title }}<br>{{ $event->date }}<br>{{ $event->bar->name }}</td>
                            <td>{{ $event->content }}</td>
                            <div class="row">
                                <div class="col-xs-6 col-md-3">
                                    <td><a href="{{ $event->event_pic }}" class="thumbnail"><img class="responsive" src="{{ $event->event_pic }}"></a></td>
                                </div>
                            </div>
                            <td><strong>By:</strong> {{ $event->user->first_name}} {{ $event->user->last_name}}<br>
                                <strong>On:</strong> {{ $event->created_at}}<br>
                                <strong>Updated on:</strong> {{$event->updated_at}}</td>
                            <td><a class="btn btn-info" href="{{action('EventsController@show', $event->id)}}">See Event</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
{{--{!! $events->render() !!}--}}
@stop