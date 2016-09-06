@extends('layouts.master')

@section('content')
    @foreach ($bars as $bar)
        <div class="row">
            <div class="col-xs-3">
                {{--add this to img src below {{ $bar->pictures()->first()->pic_url }}--}}
                <img src="" class="thumbnail responsive" height="60" width="60">
                <h2>{{ $bar->name}}</h2>
                <h5>{{ $bar->address}}</h5>
                {{--                    <h5>{{ $bar->}}</h5>--}}
                user score
                <br>
                helpful?
            </div>
            <div class="col-xs-9">
                <h4><small>posted {{ $bar->created_at->diffForHumans() }}</small></h4>
                <p class="beer-rating">{!! $bar->averageBarRating() !!}</p>
            </div>
        </div>
        <hr>
    @endforeach
@stop