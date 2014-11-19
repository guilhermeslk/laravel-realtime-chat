@extends('layouts/main')

@section('body')
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/chat">Realtime Chat</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							<img class="img-circle" width="30" height="30" src="{{ Auth::user()->image_path }}"/>
							{{ Auth::user()->username }} 
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Home</a></li>
							
							<li class="divider"></li>
							<li><a href="{{ action('AuthController@getLogout') }}">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="row">
	        <div class="col-lg-3 new-message text-right">
	            <a href="" class="btn btn-sm btn-default" role="button"><i class="fa fa-plus"></i> New Message</a>
	        </div>	        
	    </div>
	    <div class="row">
	    	<div class="list-group col-lg-3">
				@foreach($conversations as $conversation)
	                <a id="{{ $conversation->name }}" class="list-group-item {{ Session::get('current_conversation') == $conversation->name  ? 'active' : '' }}" href="/chat/?conversation={{$conversation->name}}">
						<div class="pull-left user-picture">
                    		<img class="media-object img-circle" width="30" height="30" src="{{ $conversation->users->first()->image_path }}">
                    	</div>

                    	@if($conversation->unread_messages_counter) 
	                   		<span class="badge">{{$conversation->unread_messages_counter}}</span>
	                   	@endif

						<h4 class="list-group-item-heading">
							@foreach($conversation->users as $key => $user) 
								{{ $user->username }}{{ $conversation->users->count() != ($key + 1) ? ',' : ''}}
							@endforeach
						</h4>
    					<p class="list-group-item-text"><small>{{ Str::words($conversation->messages->last()->body, 5) }}</small></p>
	                </a>
		        @endforeach
	        </div>
	        <div class="col-lg-8">
		        <div class="panel panel-default">
		        	<div id="messageList" class="panel-body messages-panel">
						@include('templates/messages', array('messages' => $current_conversation->messages))
					</div>
		        </div>
		        {{ Form::open(array('action' => 'MessageController@postStore')) }}
		            <div class="send-wrap">
		                <textarea id="messageBox" class="form-control send-message" rows="3" placeholder="Write a reply..."></textarea>
		            </div>
		            <div class="send-message">
		                <a id="btnSendMessage" class="text-right btn btn-sm btn-danger pull-right" role="button"><i class="fa fa-send"></i> Send Message</a>
		            </div>
            	{{ Form::close() }}
            </div>
	    </div>
    </div>
@stop

@section('scripts')
	<script>
		var 
			current_conversation = "{{ Session::get('current_conversation') }}",
			user_id = "{{ Auth::user()->id }}";
	</script>
	<script src="{{ asset('/js/chat.js')}}"></script>
@stop
