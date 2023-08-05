<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsCommentRequest;
use Illuminate\Http\Request;
use App\Repositories\NewsComment\NewsCommentRepositoryInterface;
class NewsCommentController extends Controller
{
    private $newsCommentRepository;


    public function __construct(NewsCommentRepositoryInterface $newsCommentRepository)
    {
        $this->newsCommentRepository = $newsCommentRepository;
    }

    public function create(NewsCommentRequest $request){
        $id_user = auth('api')->user()->id;
        $validated = $request->validated();
        $validated['users_id'] = $id_user;
        $this->newsCommentRepository->create($validated);
        return response()->json([
            'status' => true,
            'message' => 'success insert data'
        ]);
    }
}
