<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

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
                return new UserResource(true,'success login',$user);
            }else{
                //wrong password
                return response()->json([
                    'status' => false,
                    'message' => 'wrong username and password'
                ],404);
            }
        }else{
            //wrong email
            return response()->json([
                'status' => false,
                'message' => 'wrong username and password'
            ],404);
        }
       
    }
}
