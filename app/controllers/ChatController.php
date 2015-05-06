<?php

use LaravelRealtimeChat\Repositories\Conversation\ConversationRepository;
use LaravelRealtimeChat\Repositories\User\UserRepository;
    
class ChatController extends \BaseController {

    /**
     * @var LaravelRealtimeChat\Repositories\ConversationRepository
     */
    private $conversationRepository; 

    /**
     * @var LaravelRealtimeChat\Repositories\UserRepository
     */
    private $userRepository; 

    public function __construct(ConversationRepository $conversationRepository, UserRepository $userRepository)
    {
        $this->conversationRepository = $conversationRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display the chat index.
     *
     * @return Response
     */
    public function index() {

        $viewData = array();

        if(Input::has('conversation')) {
            $viewData['current_conversation'] = $this->conversationRepository->getByName(Input::get('conversation'));
        } else {
            $viewData['current_conversation'] = Auth::user()->conversations()->first();
        }

        if($viewData['current_conversation']) {
            Session::set('current_conversation', $viewData['current_conversation']->name);
    
            foreach($viewData['current_conversation']->messages_notifications as $notification) {
                $notification->read = true;
                $notification->save();
            }
        }
       
        $users = $this->userRepository->getAllExcept(Auth::user()->id);

        foreach($users as $key => $user) {
            $viewData['recipients'][$user->id] = $user->username;
        }
        
        $viewData['conversations'] = Auth::user()->conversations()->get();
        
        return View::make('templates/chat', $viewData);
    }
}
