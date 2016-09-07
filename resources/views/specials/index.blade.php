@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <table class="table table-condensed col-xs-12">
                @foreach($specials as $special)
                    <div></div>
                    <tr>
                        <td>{{ $special->title }}<br><a href="{{ action('BarsController@show', $special->bar->id)  }}">{{ $special->bar->name }}</a></td>
                        <td><strong>Added on:</strong> {{ $special->created_at->format('d-m-Y g:ia')}}<br>
                            @if($special->created_at != $special->updated_at)
                            <strong>Updated on:</strong> {{$special->updated_at->format('d-m-Y g:ia')}}</td>
                            @endif
                        <td><a class="btn btn-info" href="{{action('SpecialsController@show', $special->id)}}">See Special</a></td>
                    </tr>
                @endforeach
            </table>
            {!! $specials->render() !!}
        </div>
    </div>
@stop