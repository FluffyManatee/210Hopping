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
                <button id="image-upload" type="button" class="btn btn-default">Upload an image</button>
                <div id="dropzone">
                    <form action="{{ action('PicturesController@store') }}" method="POST" enctype="multipart/form-data" class="dropzone">
                        {{ csrf_field() }}
                    </form>
                </div>
                <button type="submit" class ="btn btn-primary pull-right">Create Event</button>
            </form>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $('#image-upload').click(function() {
            $('#dropzone').slideToggle('slow');
        });
    </script>
@stop
