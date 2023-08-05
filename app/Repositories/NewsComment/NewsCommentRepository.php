<?php

namespace App\Repositories\NewsComment;

use App\Repositories\NewsComment\NewsCommentRepositoryInterface;
use App\Models\NewsComment;

class NewsCommentRepository implements NewsCommentRepositoryInterface
{

    public function create($request)
    {
        return NewsComment::create($request);
    }

}