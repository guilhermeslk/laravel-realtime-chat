<?php

class AuthController extends \BaseController {

    public function getLogin() {
        if(Auth::user()) {
            return Redirect::route('chat.index');
        }

        return View::make('templates/login');
    }

    public function postLogin() {
        $input = Input::only(array(
            'email',
            'password'
        ));

        $rules = array(
            'email'    => 'required|email',
            'password' => 'required|min:6'
        );

        $validator = Validator::make($input, $rules);

        if($validator->fails()) {
            return Redirect::route('auth.postLogin')->withErrors($validator);
        }

        if(Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')), false)) {
            return Redirect::route('chat.index');
        }
    }

    public function logout() {
        Auth::logout();
        return Redirect::to('/');
    }

}
