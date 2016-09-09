@extends('layouts.master')
@section('content')
    {{--{{dd($bars)}}--}}
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <h4 class="modal-title">Create a gameplan</h4>
            <form method="POST" action="{{ action('GameplansController@store') }}" id="gameplanForm">
                <input type="hidden" name="hidden-bar-input" id="hidden-bar-input">
                {{ csrf_field() }}
                <div class="form-group">
                    Date<input type="date" class="form-control" name="date" id="date" placeholder="YYYY-MM-DD">
                    @include('forms.error', ['field' => 'date'])
                </div>
                <div class="form-group">
                    Time<input type="time" class="form-control" name="time" id="time" placeholder="00:00">
                    @include('forms.error', ['field' => 'time'])
                </div>
                <div class="form-group">
                    Bar1<select class="form-control barSelect" name="bar1" id="bar1">
                        <option value="">Add Bar</option>
                        @foreach($bars as $key => $bar)
                        <option value="{{ $key }}">{{ $bar }}</option>
                        @endforeach
                    </select>
                    @include('forms.error', ['field' => 'bar 1'])
                </div>
                <div class="form-group">
                    Bar2<select class="form-control barSelect" name="bar2" id="bar2">
                        <option value="">Add Bar</option>
                        @foreach($bars as $key => $bar)
                            <option value="{{ $key }}">{{ $bar }}</option>
                        @endforeach
                    </select>
                    @include('forms.error', ['field' => 'bar 2'])
                </div>
                <div class="form-group">
                    Bar3<select class="form-control barSelect" name="bar3" id="bar3">
                        <option value="">Add Bar</option>
                        @foreach($bars as $key => $bar)
                            <option value="{{ $key }}">{{ $bar }}</option>
                        @endforeach
                    </select>
                    @include('forms.error', ['field' => 'bar 3'])
                </div>
                <div class="form-group">
                    Bar4<select class="form-control barSelect" name="bar4" id="bar4">
                        <option value="">Add Bar</option>
                        @foreach($bars as $key => $bar)
                            <option value="{{ $key }}">{{ $bar }}</option>
                        @endforeach
                    </select>
                    @include('forms.error', ['field' => 'bar 4'])
                </div>
                <div class="form-group">
                    Bar5<select class="form-control barSelect" name="bar5" id="bar5">
                        <option value="">Add Bar</option>
                        @foreach($bars as $key => $bar)
                            <option value="{{ $key }}">{{ $bar }}</option>
                        @endforeach
                    </select>
                    @include('forms.error', ['field' => 'bar 5'])
                </div>
                <button type="submit" class ="btn btn-primary pull-right">Create</button>
            </form>
        </div>
    </div>
@stop