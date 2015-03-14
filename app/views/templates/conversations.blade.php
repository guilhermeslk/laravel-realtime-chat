<div class="list-group col-lg-3">
    @foreach($conversations as $conversation)
        <a id="{{ $conversation->name }}" class="list-group-item {{ Session::get('current_conversation') == $conversation->name  ? 'active' : '' }}" href="/chat/?conversation={{$conversation->name}}">
            <div class="pull-left user-picture">
                <img class="media-object img-circle" width="30" height="30" src="{{ $conversation->users->first()->image_path }}">
            </div>

            @if($conversation->messages_notifications->count()) 
                <span class="badge">{{ $conversation->messages_notifications->count() }}</span>
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
