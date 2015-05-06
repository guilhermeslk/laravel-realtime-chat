$(function() {

    /***
        Initialization
    ***/

    scrollToBottom();

    var
        socket = io('http://localhost:3000'),

        jqxhr  = $.ajax({
            url: '/users/' + user_id + '/conversations',
            type: 'GET',
            dataType: 'json'
        });

    jqxhr.done(function(data) {
        if(data.success && data.result.length > 0) {
            $.each(data.result, function(index, conversation) {
                socket.emit('join', { room:  conversation.name });
            });
        }
    });

    /***
        Socket.io Events
    ***/

    socket.on('welcome', function (data) {
          console.log(data.message);

          socket.emit('join', { room:  user_id });
      });

      socket.on('joined', function(data) {
          console.log(data.message);
      });

    socket.on('chat.messages', function(data) {
        var
            $messageList  = $("#messageList"),
            $conversation = $("#" + data.room);

        var message      = data.message.body,
            from_user_id = data.message.user_id,
            conversation = data.room;

        getMessages(conversation).done(function(data) {

            $conversation.find('small').text(message);

            if(conversation === current_conversation) {
                $messageList.html(data);
                scrollToBottom();
            }

            if(from_user_id !== user_id && conversation !== current_conversation) {
                updateConversationCounter($conversation);
            }
        });
       });

       socket.on('chat.conversations', function(data) {
           var $conversationList = $("#conversationList");

           getConversations(current_conversation).done(function(data) {
               $conversationList.html(data);
           });
       });

    /***
        Functions
    ***/

    function getConversations(current_conversation) {
        var jqxhr = $.ajax({
                url: '/conversations',
                type: 'GET',
                data: { conversation: current_conversation },
                dataType: 'html'
            });

        return jqxhr;
    }

    function getMessages(conversation) {
           var jqxhr = $.ajax({
            url: '/messages',
            type: 'GET',
            data: { conversation: conversation },
            dataType: 'html'
        });

        return jqxhr;
    }

    function sendMessage(body, conversation, user_id) {
        var jqxhr = $.ajax({
            url: '/messages',
            type: 'POST',
            data:  { body: body , conversation: conversation, user_id: user_id },
            dataType: 'json'
        });

        return jqxhr;
    }

    function updateConversationCounter($conversation) {
        var
            $badge  = $conversation.find('.badge'),
            counter = Number($badge .text());

        if($badge.length) {
            $badge.text(counter + 1);
        } else {
            $conversation.prepend('<span class="badge">1</span>');
        }
    }

    function scrollToBottom() {
        var $messageList  = $("#messageList");

        if($messageList.length) {
            $messageList.animate({scrollTop: $messageList[0].scrollHeight}, 500);
        }
    }

    /***
        Events
    ***/

    $('#btnSendMessage').on('click', function (evt) {
        var $messageBox  = $("#messageBox");

        evt.preventDefault();

        sendMessage($messageBox.val(), current_conversation, user_id).done(function(data) {
            console.log(data);
            $messageBox.val('');
            $messageBox.focus();
        });
    });

    $('#btnNewMessage').on('click', function() {
        $('#newMessageModal').modal('show');
    });
    
    /**
     * Shift+Enter to send message
     */
    $('#messageBox').keypress(function (event) {
        if (event.keyCode == 13 && event.shiftKey) {
            event.preventDefault();
            
            $('#btnSendMessage').trigger('click');
        }
    });
});
