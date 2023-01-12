<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Interfaces\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index()
    {
        $products = $this->repository->index();

        return view('product.index', compact('products'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function show($id)
    {
        $product = $this->repository->show($id);
        return view('product.show', compact('product'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function edit($id)
    {
        $product = $this->repository->show($id);

        return view('product.edit', compact('product'));
    }

    /**
     * @param               $id
     * @param UpdateRequest $request
     *
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, UpdateRequest $request)
    {
        try {
            $this->repository->update($id, $request->validated());
            session()->flash('success', 'Update Product successfully');
        } catch (\Exception $exception) {
            session('error', $exception->getMessage());
        }

        return redirect(route('products.index'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->destroy($id);
            return response(['msg' => 'Delete success!'], 200);
        } catch (\Exception $exception) {
            return response(['msg' => $exception->getMessage()], 400);
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteMultiple(Request $request)
    {
        try {
            $ids = $request->input('ids');
            $this->repository->query()->whereIn('id', $ids)->delete();
            return response(['msg' => __('Delete Prodcuct successful'), 'success' => true], 200);
        } catch (\Exception $exception) {
            return response(['msg' => __('Delete Prodcuct failed') . $exception->getMessage()], 400);
        }
    }

    /**
     * @param CreateRequest $request
     *
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateRequest $request)
    {
        try {
            $this->repository->store($request->validated());
            session()->flash('success', 'Create Product successfully');
        } catch (\Exception $exception) {
            session()->flash('error', 'Create Product failed');
            return back();
        }

        return redirect(route('products.index'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function create()
    {
        return view('product.create');
    }
}
