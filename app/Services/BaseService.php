<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use App\Traits\HasTransformer;

abstract class BaseService
{
    use HasTransformer;

    protected BaseRepository $repository;
    protected $transformer = null;

    public function __construct(BaseRepository $repository, $transformer)
    {
        $this->repository = $repository;
        $this->transformer = $transformer;
    }

    public function index()
    {
        $data = $this->repository->index();
        return $this->httpOk($data, $this->transformer);
    }

    public function show($id)
    {
        $resource = $this->repository->show($id);
        return $this->httpOk($resource, $this->transformer);
    }

    public function store($params)
    {
        $resource = $this->repository->store($params);
        return $this->httpCreated($resource, $this->transformer);
    }

    public function storeMany($data, $attribute = [])
    {
        $resource = $this->repository->storeMany($data);

        return $this->httpCreated($resource, $this->transformer);
    }

    public function update($id, $params)
    {
        $resource = $this->repository->update($id, $params);
        return $this->httpOk($resource, $this->transformer);
    }

    public function destroy($id)
    {
        $this->repository->destroy($id);
        return $this->httpNoContent();
    }
}