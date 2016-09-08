@extends('layouts.master')

@section('content')
        <div class="container">

                <table class="table table-condensed col-xs-12">
                    @foreach($events as $event)
                        <div></div>
                        <tr>
                            <td>
                                {{ $event->title }}<br>
                                {{ $event->date->format('l, F j Y')  }}<br>
                                <a href="{{ action('BarsController@show', $event->bar->id) }}">{{ $event->bar->name }}</a>
                            </td>
                            <div class="row">
                                <div class="col-xs-6 col-md-3">
                                    <td><a href="{{ $event->event_pic }}"><img class="thumbnail" src="{{ $event->event_pic }}"></a></td>
                                </div>
                            </div>
                            <td>
                                <strong>Submitted By:</strong><br>
                                <a href="{{ action('UserController@show', $event->user->id) }}"> {{ $event->user->first_name}} {{ $event->user->last_name}}</a><br>
                                <strong>On:</strong><br>
                                {{ $event->created_at->format('d-m-Y g:ia')}}<br>
                                @if($event->created_at != $event->updated_at)
                                <strong>Updated on:</strong><br>
                                    {{$event->updated_at->format('d-m-Y g:ia')}}
                                @endif
                            </td>
                            <td><a class="btn btn-info" href="{{action('EventsController@show', $event->id)}}">See Event</a></td>
                        </tr>
                    @endforeach
                </table>

        </div>
{{--{!! $events->render() !!}--}}
@stop