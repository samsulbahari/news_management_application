<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Http\Resources\NewsResouce;
use Illuminate\Http\Request;
use App\Repositories\News\NewsRepositoryInterface;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    private $newsRepository;


    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function index(){
        $news =  $this->newsRepository->getAll();
        return NewsResouce::collection($news);
    }

    public function create(NewsRequest $request){
        $validated = $request->validated();
        $image_path = $request->file('image')->store('image', 'public');
        $validated['image'] = $image_path;
        $this->newsRepository->create($validated);
        return response()->json([
            'status' => true,
            'message' => 'success insert data'
        ]);
    }

    public function update(NewsRequest $request){
        $validated = $request->validated();
        $id = request()->query('id');
        $check_id =  $this->newsRepository->getById($id);
        if($check_id){
            //delete image
            Storage::disk('local')->delete('public/'.$check_id->image);

            //upload new image
            $image_path = $request->file('image')->store('image', 'public');
            $validated['image'] = $image_path;
            $this->newsRepository->update($id,$validated);
            return response()->json([
                'status' => true,
                'message' => 'success update data'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'failed edit data'
            ],500);
        }
     
    }

    public function delete(){
        $id = request()->query('id');
        $check_id =  $this->newsRepository->getById($id);
        if($check_id){
            Storage::disk('local')->delete('public/'.$check_id->image);
            $this->newsRepository->delete($id);
            return response()->json([
                'status' => true,
                'message' => 'succes delete data'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'id not found '
            ],500);
        }
    }

    public function getid(){
        $id = request()->query('id');
        $data = Redis::get('news_'.$id);
        if($data){
            //if news id available on redis
            return json_decode($data);
        }else{
            $news =  $this->newsRepository->getById($id);
            if($news){
                return new NewsResouce($news);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'id not found '
                ],500);
            }
        }
      
    }
}
