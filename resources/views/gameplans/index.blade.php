@extends('layouts.master')

@section('content')
    {{--<div></div>--}}
    <div id="header" style="background-image:url('/img/gobletsedit.jpg'); background-position: center center; background-repeat: no-repeat; background-size: 100%;width:auto; height:500px;">
    </div>
    <div class="container">
        <div class="col-xs-5"></div>
        <div class="col-xs-2"><br>
            <a class="btn btn-warning" href="gameplans/create">Create Gameplan</a>
        </div>
        @foreach($gameplans as $gameplan)
            <div class="row">
                <table class="table table-condensed col-xs-12">
                    <div class="container"><br><br>
                        <h3><a href="{{ action('GameplansController@show', $gameplan->id) }}">Gameplan
                                for {{ $gameplan->date->format('Y-m-d') }}</a></h3>
                        {{--code above is awesome this is the wrong place for it--}}
                        {{--<h3>Gameplan for {{ $gameplan->date }}</h3>--}}
                        <h4>Head Hopper:</h4>
                        <a href="/users/{{ $gameplan->author->id }}">
                            <h5>{{ $gameplan->author->first_name . ' ' . $gameplan->author->formatLastName() }}</h5></a>
                        {{--<h2>{{ $gameplan->date()->format('l, F jS Y') }}</h2>--}}

                        <h4>Hoppers:</h4>
                        @foreach($gameplan->hoppers as $hopper)
                            <h5>{{ $hopper->user->first_name . ' ' . $hopper->user->formatLastName() }}</h5>
                        @endforeach
                        @if((Auth::user()) && (Auth::user()->id == $gameplan->author_id))
                            <div>
                                <a class="btn btn-success"
                                   href="{{action('GameplansController@edit', $gameplan->id) }}">Edit Gameplan</a>
                                <form method="POST"
                                      action="{{action('GameplansController@destroy', $gameplan->id) }}">
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
@section('scripts')
    <script>
        $('.carousel').carousel({
            interval: 4000
        });
        $('.item').click(function (e) {
            var $barId = $(this).data('value');
            $(location).attr('href', '/bars/' + $barId);
        });
    </script>
@stop