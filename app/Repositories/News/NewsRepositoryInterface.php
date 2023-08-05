<?php
namespace App\Repositories\News;

Interface NewsRepositoryInterface{
    public function getAll();
    public function create($request);
    public function update($id,$request);
    public function getById($id);
    public function delete($id);
}