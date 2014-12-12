<?php

class ConversationController extends \BaseController {

    /**
     * Display a listing of conversations.
     *
     * @return Response
     */
    public function index() {
        $current_conversation = Conversation::where('name',  Input::get('conversation'))->firstOrFail();
        $conversations        = Auth::user()->conversations()->get();
        $users                = User::where('id', '<>', Auth::user()->id)->get();
        $recipients           = array();

        foreach($users as $key => $user) {
            $recipients[ $user->id] = $user->username;
        }

        return View::make('templates/conversations')->with(array(
            'conversations'        => $conversations,
            'current_conversation' => $current_conversation,
            'recipients'            => $recipients
        ));
    }

    /**
     * Store a newly created conversation in storage.
     *
     * @return Response
     */
    public function store() {

        $rules = array(
            'users' => 'required|array',
            'body'  =>  'required'
        );

        $validator = Validator::make(Input::only('users', 'body'), $rules);

        if($validator->fails()) {
            return Response::json([
                'success' => false,
                'result' => $validator->messages()
            ]);
        }

        // Create Conversation
        $params = array(
            'created_at' => new DateTime,
            'name'          => str_random(30),
            'author_id'  => Auth::user()->id
        );

        $conversation = Conversation::create($params);

        $conversation->users()->attach(Input::get('users'));
        $conversation->users()->attach(array(Auth::user()->id));

        // Create Message
        $params = array(
            'conversation_id' => $conversation->id,
            'body'               => Input::get('body'),
            'user_id'           => Auth::user()->id,
            'created_at'      => new DateTime
        );

        $message = Message::create($params);

        // Create Message Notifications
        $messages_notifications = array();

        foreach(Input::get('users') as $user_id) {
            array_push($messages_notifications, new MessageNotification(array('user_id' => $user_id, 'read' => false, 'conversation_id' => $conversation->id)));

            // Publish Data To Redis
               $data = array(
                'room'    => $user_id,
                'message' => array('conversation_id' => $conversation->id)
            );

            Event::fire(ChatConversationsEventHandler::EVENT, array(json_encode($data)));
        }

        $message->messages_notifications()->saveMany($messages_notifications);

        return Redirect::route('chat.index', array('conversation', $conversation->name));
    }
}
