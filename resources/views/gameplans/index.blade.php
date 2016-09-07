@extends('layouts.master')

@section('content')
    {{--{{dd($gameplans)}}--}}
    <div class="container">
        <div>
            <h5>Going out with some friends? Create a Gameplan so everyone knows where you're hanging out tonight!</h5>
        </div>
        <div>
            <a class="btn btn-warning" href="gameplans/create">Create Gameplan</a>
        </div>
        @foreach($gameplans as $gameplan)
            <div class="row">
                <table class="table table-condensed col-xs-12">
                    <div class="container">
                        <h3><a href="{{ action('GameplansController@show', $gameplan->id) }}">Gameplan for {{ $gameplan->date }}</a></h3>
                        {{--code above is awesome this is the wrong place for it--}}
                        {{--<h3>Gameplan for {{ $gameplan->date }}</h3>--}}
                        <h4>Head Hopper:</h4>
                        <h5>{{ $gameplan->author->first_name . ' ' . $gameplan->author->formatLastName() }}</h5>
                        {{--<h2>{{ $gameplan->date()->format('l, F jS Y') }}</h2>--}}
                        <h4>Hop-Stops:</h4>
                        @foreach($gameplan->bars as $gpbar)
                            <a href="/bars/{{ $gpbar->bar->id }}"><h5>{{ $gpbar->bar->name }}</h5></a>
                            {{--<div class="row">--}}
                            {{--<div class="col-xs-6 col-md-3">--}}
                            {{--<a href="{{ $gpbar->bar->pictures->first()->pic_url or '' }}" class="thumbnail">--}}
                            {{--<img src="{{ $gpbar->bar->pictures->first()->pic_url or '' }}">--}}
                            {{--</a>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                        @endforeach
                        {{--{{ dd($gameplan->hoppers()->first()->user->first_name) }}--}}
                        <h4>Hoppers:</h4>
                        @foreach($gameplan->hoppers as $hopper)
                            <h5>{{ $hopper->user->first_name . ' ' . $hopper->user->formatLastName() }}</h5>
                        @endforeach
                        {{--<a href="addHopper/{{ $gameplan->id }}"><h5>Join Gameplan</h5></a>--}}
                        @if((Auth::user()) && (Auth::user()->id == $gameplan->author_id))
                            <div>
                                <a class="btn btn-success"
                                   href="{{action('GameplansController@edit', $gameplan->id) }}">Edit Gameplan</a>
                                <form method="POST" action="{{action('GameplansController@destroy', $gameplan->id) }}">
                                    <input type="submit" class="btn btn-danger" value="Delete Event">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                </form>
                            </div>
                    @endif
                </table>
            </div>
        @endforeach
    </div>
    {!! $gameplans->render() !!}
@stop