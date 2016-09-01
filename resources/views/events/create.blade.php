@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <h4 class="modal-title">Add an event</h4>
            <form method="POST" action="{{ action('EventsController@store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" name="title" id="title" placeholder="Event Name">
                    @include('forms.error', ['field' => 'title'])
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="date" id="date" placeholder="Date (yyyy-mm-dd)">
                    @include('forms.error', ['field' => 'date'])
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="content" id="content" placeholder="Description"></textarea>
                    @include('forms.error', ['field' => 'content'])
                </div>
                <button type="submit" class ="btn btn-primary pull-right">CREATE</button>
            </form>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(function() {
            $( "#datepicker" ).datepicker();
        });
    </script>
@stop
