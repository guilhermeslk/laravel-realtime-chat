@extends('layouts/main')

@section('body')
    <div class="container">
        <div class="row" style="margin-top: 30px;">
            <div class="col-sm-offset-3 col-sm-6 well">
                <h2>Welcome to Realtime Chat!</h2>
                <hr/>
                {{ Form::open(array('action' => 'AuthController@postLogin')) }}
                    <div class="form-group">
                        {{ Form::label('email', 'E-mail', array('class' => 'control-label')) }}
                        {{ Form::text('email', null, array( 'class' => 'form-control')) }}
                        <span class="help-block">(e.g., heisenberg@gmail.com, pinkman@gmail.com) </span>
                    </div>
                    <div class="form-group">
                        {{ Form::label('password','Password', array('class' => 'control-label')) }}
                        {{ Form::password('password',  array('class' => 'form-control')) }}
                        <span class="help-block">(e.g., heisenberg, pinkman) </span>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-danger">Sign in</button>
                    </div>
                {{ Form::close() }}
                @if($errors)
                    <ul class="text-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif				
            </div>
        </div>
    </div>
@stop
