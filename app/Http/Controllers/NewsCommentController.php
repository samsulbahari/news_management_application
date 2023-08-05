<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsCommentRequest;
use Illuminate\Http\Request;
use App\Repositories\NewsComment\NewsCommentRepositoryInterface;
use App\Repositories\News\NewsRepositoryInterface;
use Illuminate\Support\Facades\Redis;

class NewsCommentController extends Controller
{
    private $newsCommentRepository;
    private $newsRepository;

    public function __construct(NewsCommentRepositoryInterface $newsCommentRepository,NewsRepositoryInterface $newsRepository)
    {
        $this->newsCommentRepository = $newsCommentRepository;
        $this->newsRepository = $newsRepository;
    }

    public function create(NewsCommentRequest $request){
      

        $id_user = auth('api')->user()->id;
        $validated = $request->validated();
        $validated['users_id'] = $id_user;
        $this->newsCommentRepository->create($validated);

        //update redis news by id
        $data_news_by_id = collect([
            'data' => $this->newsRepository->getById($request->news_id)
        ]);
        $json_news_id  = json_encode($data_news_by_id);
        Redis::set('news_'.$request->news_id, $json_news_id);
        return response()->json([
            'status' => true,
            'message' => 'success insert data'
        ]);
    }
}
