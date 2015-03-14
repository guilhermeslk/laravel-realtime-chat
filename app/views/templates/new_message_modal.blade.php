<div id="newMessageModal" class="modal fade">
    <div class="modal-dialog">
        {{ Form::open( array('action' => 'ConversationController@store')) }}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">New Message</h4>
            </div>
            <div class="modal-body">				
                <div class="form-group">
                    {{ Form::label('users[]', 'Users') }} 
                    {{ Form::select('users[]', $recipients, null, array("multiple" => "multiple", "class" => "form-control")) }} 
                </div>
                <div class="form-group">
                    {{ Form::label('body', 'Message') }} 
                    {{ Form::textarea('body', null, array("rows" => "6", "class" => "form-control")) }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {{ Form::submit('Send', array('class' => 'btn btn-danger')) }}
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
