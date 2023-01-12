<?php

namespace App\Http\Controllers;

use App\Services\BaseService;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    protected BaseService $service;

    public function __construct(BaseService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function store(Request $request)
    {
        return $this->service->store($request->input());
    }

    public function update($id, Request $request)
    {
        return $this->service->update($id, $request->input());
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
