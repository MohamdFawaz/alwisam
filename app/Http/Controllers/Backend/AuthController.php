<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\User\AdminChangePasswordRequest;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        app()->setLocale('ar');
    }

    public function showResetPasswordForm()
    {
        return view('auth.reset-password');
    }

    public function resetPassword(AdminChangePasswordRequest $request)
    {
        $input = ['user_id' => auth()->user()->id,'new_password' => $request->password];
        $this->repository->updatePasswordLogin($input);
        return redirect('admin/home');
    }
}
