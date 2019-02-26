<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\User\ActivateAccountRequest;
use App\Http\Requests\User\ForgotPasswordRequest;
use App\Models\Category;
use App\Models\User;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\ExamType\ExamTypeRepository;
use Illuminate\Http\Request;
use App\Http\Requests\User\SignupRequest;

class CategoryController extends APIController
{
    protected $repository;
    protected $examTypeRepository;

    /**
     * __construct.
     *
     * @param $repository
     * @param $request
     * @param $tempUserRepository
     * @param $socialLoginRepository
     */
    public function __construct(CategoryRepository $repository,ExamTypeRepository $examTypeRepository, Request $request)
    {
        $this->repository = $repository;
        $this->examTypeRepository = $examTypeRepository;
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
    public function index()
    {
        $categories = Category::whereNull('parent')->with('child')->get();
        $list = $this->repository->getCategoryList($categories);
        return $this->respond(trans('messages.category.list'),$list);
    }

    /**
     * Log the user in.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubCategories($parent)
    {
        $categories = Category::where('parent',$parent)->get();
        if($parent != 4){
            $list = $this->repository->getCategoryList($categories);
        }else{
            $list = $this->examTypeRepository->getExamTypeAll();
        }
        return $this->respond(trans('messages.category.list'),$list);
    }


}
