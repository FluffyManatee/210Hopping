@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <h4 class="modal-title">Update bar information</h4>
            <form method="POST" action="{{ action('BarsController@update', $bar->id) }}">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" name="name" id="name" value="{{ $bar->name }}" placeholder="Bar name">
                    @include('forms.error', ['field' => 'name'])
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="address" id="address" value="{{ $bar->address }}" placeholder="Bar address">
                    @include('forms.error', ['field' => 'address'])
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="phone" id="phone" value="{{ $bar->phone }}" placeholder="Phone number">
                    @include('forms.error', ['field' => 'phone'])
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="website" id="website" value= "{{ $bar->website }}" placeholder="Bar website">
                    @include('forms.error', ['field' => 'website'])
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="email" id="email" value="{{ $bar->email }}" placeholder="Bar email">
                    @include('forms.error', ['field' => 'email'])
                </div>
                <select name="type" id="type">
                    <option value="">Bar type...</option>
                    <option value="pub">Pub</option>
                    <option value="dive">Dive</option>
                    <option value="club">Club</option>
                    <option value="sports">Sports</option>
                    <option value="karaoke">Karaoke</option>
                    <option value="rock">Rock</option>
                    <option value="jazz">Jazz</option>
                    <option value="taproom">Taproom</option>
                    <option value="cocktail">Cocktail</option>
                </select>
                @include('forms.error', ['field' => 'type'])
                <button type="submit" class ="btn btn-primary pull-right">Update</button>
            </form>
        </div>
    </div>
@stop