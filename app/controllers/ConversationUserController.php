<?php

class ConversationUserController extends \BaseController {

    /**
     * Display a listing of user conversations.
     *
     * @return Response
     */
    public function index($user_id) {
        $conversations_users = ConversationUser::where('user_id', $user_id)->lists('conversation_id');

        $conversations = array();

        if($conversations_users) {
            $conversations = Conversation::whereIn('id', $conversations_users)->get();
        }

        return Response::json([
            'success' => true,
            'result' => $conversations
        ]);
    }
}
