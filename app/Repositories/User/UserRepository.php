<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Setting\SettingRepository;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;


/**
* Class NotificationRepository.
*/
class UserRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;
    public $settingRepository;

    public function __construct(User $model, SettingRepository $settingRepository)
    {
        $this->model = $model;
        $this->settingRepository= $settingRepository;
    }

    public function getLoggedUserDetails($user)
    {
        $data['id'] = $user['id'];
        $data['first_name'] = ucwords($user['first_name']);
        $data['last_name'] = ucwords($user['last_name']);
        $data['phone'] = $user['phone'];
        $data['email'] = $user['email'];
        $data['user_image'] = $user['user_image'];
        $data['jwt_token'] = $user['jwt_token'];
        $data['user_status'] = $user['user_status'];
        return $data;
    }

    public function create($input)
    {
        $jwt_token = str_random(25);
        $array = array(
            'email' => $input['email'],
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'firebase_token' => $input['firebase_token'],
            'jwt_token' => $jwt_token,
            'password' => Hash::make($input['password']),
            'phone' => $input['phone'],
            'user_image' => $input['user_image'],
        );
        //If user saved successfully, then return true
        if ($user = User::create($array)) {
            $input->user_id = $user->id;
            //add new address with user id
            return ['user_id' => $user->id,'jwt_token' => $jwt_token];
        }

        return false;
    }
    public function update($input, $user_image)
    {

        $user = User::whereId($input->user_id)->first();
        $user->email = $input->email;
        $user->first_name = $input->first_name;
        $user->last_name = $input->last_name;
        $user->lat = $input->lat;
        $user->lng = $input->lng;
        $user->location = $input->location;
        $user->phone = $input->phone;

        if($user_image){
            $user->user_image = $user_image;
        }
        //If user saved successfully, then return true
        if ($user->save()) {
            $data = $this->getLoggedUserDetails($user);
            return $data;
        }

        return false;
    }


    public function updatePasswordProfile($input)
    {
        $updated = false;
        $user = User::whereId($input['user_id'])->first();
        if(Hash::check($input['old_password'],$user->password)){
            $user->password = Hash::make($input['new_password']);
            $updated = $user->save();
        }else{
            return -1; // if old password is wrong
        }

        //If user saved successfully, then return true
        if ($updated) {
            return true;
        }
        return false;
    }

    public function updatePasswordLogin($input)
    {
        $user = User::whereId($input['user_id'])->first();
        $user->password = Hash::make($input['new_password']);
        //If user saved successfully, then return true
        if ($user->save()) {
            return true;
        }
        return false;
    }


    public function switchUserLanguage($input)
    {
        $user = User::whereId($input['user_id'])->first();
        $user->lang = $input['lang'];
        //If user saved successfully, then return true
        if ($user->save()) {
            return true;
        }
        return false;
    }

    public function change($input)
    {
        $user = User::whereId($input['user_id'])->first();
        $user->lang = $input['lang'];
        //If user saved successfully, then return true
        if ($user->save()) {
            return true;
        }
        return false;
    }

    public function logoutUser($input)
    {
        $user = User::whereId($input['user_id'])->first();
        $user->firebase_token = null;
        //If firebase_token cleared successfully, then return true
        if ($user->save()) {
            return true;
        }
        return false;
    }

    public function activate($input)
    {
        $user = User::whereId($input['user_id'])->first();
        $user->firebase_token = null;
        //If firebase_token cleared successfully, then return true
        if ($user->save()) {
            return true;
        }
        return false;
    }

     public function checkIfCodeExists($input)
    {
        $user = User::where('phone',$input['phone'])->where('activate_code',$input['activate_code'])->where('user_status',0)->first();
        return $user;
    }

     public function changeUserCode($user,$new_code)
    {
        $user->activate_code = $new_code;
        $user->user_status  = 0;
        $user->save();
        return true;
    }

    public function sendSMS($mobile_number)
    {

        $username = $this->settingRepository->getSettingByKey('sms_username');
        $password = $this->settingRepository->getSettingByKey('sms_password');
        $message = $this->settingRepository->getSettingByKey('sms_message');
        $sender = $this->settingRepository->getSettingByKey('sms_sender');
        $rand_number = rand(1111,9999);
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => '',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);

        $req = $client->request('GET','',
            ['query' =>
                [
                'mobile' => $username,
                'password' => $password,
                'numbers' => $mobile_number,
                'sender' => $sender,
                'msg' => $message.$rand_number,
                'applicationType' => '24',
                'lang' => '3',
                ]
            ]
        );
        return ['response'=> json_decode($req->getBody()),'code'=>$rand_number];
    }


    public function createSocial($input)
    {
        $fullname = explode(' ', $input->username);
        $input['first_name'] = $fullname[0];
        $input['last_name'] = $fullname[1];
        $input['jwt_token'] = str_random(25);
        $input['socialaccount']= (object)['profile_picture' => $input['profile_picture']];
        if(User::find($input['email']) === null){
            //If user saved successfully, then return true
            $createUser = User::create([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'user_status' => 1,
                'jwt_token' => $input['jwt_token']
            ]);
            if ($createUser) {
                return $this->getLoggedUserDetails($input);
            }
        }
        return false;
    }
    public function sendActivationSMS(){

    }
}