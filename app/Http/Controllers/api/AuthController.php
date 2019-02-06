<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\User\ActivateAccountRequest;
use App\Http\Requests\User\ForgotPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepository;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\SignupRequest;

class AuthController extends APIController
{
    protected $repository;
    protected $tempUserRepository;
    protected $socialLoginRepository;

    /**
     * __construct.
     *
     * @param $repository
     * @param $request
     * @param $tempUserRepository
     * @param $socialLoginRepository
     */
    public function __construct(UserRepository $repository, Request $request)
    {
        $this->repository = $repository;
        $this->setLang('ar');
        $request->headers->set('Accept', 'application/json');
    }
    /**
     * Log the user in.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $user->firebase_token = $request->firebase_token;
            $user->jwt_token = str_random(25);
            $user->save();
            return $this->respond(
                trans('messages.auth.logged_in'),
                $this->repository->getLoggedUserDetails($user)
            );
        }else{
            return $this->respondWithError(trans('messaged.auth.login_failed'));
        }
    }


    /**
     * Signup the user.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(SignupRequest $request)
    {
        if($user = $this->repository->create($request->all())){
            return $this->respond(
                200,
                trans('messages.auth.created_successfully'),
                $user
            );
        }else{
            return $this->respondWithError(trans('messages.something_went_wrong'));
        }
    }


    public function activateAccount(ActivateAccountRequest $request)
    {
        $user  = $this->repository->checkIfCodeExists($request->all());
        if(!$user){
            return $this->respondWithError(trans('messages.auth.wrong_activate_code'));
        }else{
            $user->user_status = 1;
            $user->save();
            $user = $this->repository->getLoggedUserDetails($user);
            return $this->respond(trans('messages.auth.activated_successfully'),$user);
        }
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $user = User::where('phone',$request->phone)->first();
        if(!$user){
            return $this->respondWithError(trans('messages.auth.phone_not_exists'));
        }
        $sms_code = $this->repository->sendSMS($user->phone);
        $sms_code['response'] = 1;
        if($sms_code['response']== '1'){
            $user->activate_code = $sms_code['code'];
            $user->user_status = 0;
            $user->jwt_token = str_random(25);
            $user->save();
            $userDetails = $this->repository->getLoggedUserDetails($user);
            return $this->respond(trans('messages.auth.message_sent'),$userDetails);
        }else{
            return $this->respondWithError(trans('messages.something_went_wrong'));
        }
    }

}
