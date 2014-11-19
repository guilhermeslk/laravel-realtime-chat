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
		if(data.success) {
			$.each(data.result, function(index, conversation) {
				socket.emit('join', { conversation:  conversation.name });
			});
		}
	});

	socket.on('welcome', function (data) {
  		console.log(data.message);
  	});

	socket.on('messages.update', function(data) {
		var 
			$messageList  = $("#messageList"),
			$conversation = $("#" + data.conversation);
	
		var message 	 = data.result,
			from_user_id = data.user_id,
			conversation = data.conversation;
		
   		var jqxhr = $.ajax({
			url: '/messages',
			type: 'GET',
			data: { conversation: data.conversation },
			dataType: 'html'
		});

		jqxhr.done(function(data) {
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

	/***
		Functions
	***/

	function sendMessage(evt) {
		var 
			$messageBox  = $("#messageBox");

		var jqxhr = $.ajax({
			url: '/messages',
			type: 'POST',
			data:  { body: $messageBox.val(), conversation: current_conversation, user_id: user_id },
			dataType: 'json'
		});

		jqxhr.done(function(data) {
			$messageBox.val('');
			$messageBox.focus();
		});
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

		$messageList.animate({scrollTop: $messageList[0].scrollHeight}, 500);
	}

	$("#btnSendMessage").on('click', sendMessage);
});