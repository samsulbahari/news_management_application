<?php

namespace App\Repositories\News;

use App\Repositories\News\NewsRepositoryInterface;
use App\Models\News;

class NewsRepository implements NewsRepositoryInterface
{

    public function getAll()
    {
        return News::orderBy('updated_at', 'desc')->paginate(10);
    }

    public function create($request)
    {
        return News::create($request);
    }
    public function update($id,$request)
    {
        return News::where('id',$id)->update($request);
    }
    public function getById($id)
    {
        return News::with([
            'comment' => [
                'user',
            ],
        ])->where('id',$id)->first();
    }
    public function delete($id)
    {
        return News::where('id',$id)->delete();
    }

}