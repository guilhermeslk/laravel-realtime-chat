<?php

Event::listen(ChatMessagesEventHandler::EVENT, 'ChatMessagesEventHandler');
Event::listen(ChatConversationsEventHandler::EVENT, 'ChatConversationsEventHandler');