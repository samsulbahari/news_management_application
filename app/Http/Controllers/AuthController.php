<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $userRepository;


    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function login(LoginRequest $request){
        $validated = $request->validated();
    
        $user =  $this->userRepository->getUserByEmail($request->email);
        if($user){
            //if email valid
            if(Hash::check($request->password, $user->password)){ 
                //password valid
                $user['token'] =   $user->createToken('loginweb')->accessToken;
                return new UserResource(true,'login success', $user);
            }else{
                //wrong password
                return new UserResource(false,'email or password wrong', null);
            }
        }else{
            //wrong email
            return new UserResource(false,'email or password wrong', null);
        }
       
    }
}
