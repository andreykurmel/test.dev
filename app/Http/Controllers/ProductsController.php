<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Models\Product;
use App\Models\User;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    private $productService;
    private $routePrefix;

    /**
     * Create new instance of ProductsController
     *
     * @param ProductService $service
     * @param Request $request
     */
    public function __construct(ProductService $service, Request $request) {
        $this->productService = $service;

        //without this not working console (php artisan route:list)
        if ($request->route()) {
            $this->routePrefix = substr($request->route()->getPrefix(), 1);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->routePrefix == 'user') {
            $data['products'] = $this->productService->getByUserId(Auth::user()->id);
        } else {
            $data['products'] = $this->productService->getAll();
        }

        $data['messages'] = session('status');
        $data['routePrefix'] = $this->routePrefix ? $this->routePrefix.'.' : '';
        return view('products.all', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['routePrefix'] = $this->routePrefix ? $this->routePrefix.'.' : '';
        return view('products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $createdProduct = $this->productService->create($request->all());

        $route = ($this->routePrefix ? $this->routePrefix.'.' : '') . 'products.edit';
        return redirect()->route($route, $createdProduct->id);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Product $product)
    {
        $data['product'] = $product;
        $data['routePrefix'] = $this->routePrefix ? $this->routePrefix.'.' : '';
        return view('products.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Product $product)
    {
        $data['product'] = $product;
        $data['routePrefix'] = $this->routePrefix ? $this->routePrefix.'.' : '';
        return view('products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $result = $this->productService->update($id, $request->all());

        if ($result) {
            $request->session()->flash('status.info', 'Successfully updated.');
        } else {
            $request->session()->flash('status.error', 'Product not found.');
        }

        $route = ($this->routePrefix ? $this->routePrefix.'.' : '') . 'products.index';
        return redirect()->route($route);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $result = $this->productService->delete($id);

        if ($result) {
            $request->session()->flash('status.info', 'Successfully deleted.');
        } else {
            $request->session()->flash('status.error', 'Cannot find this product, maybe it has already been deleted?.');
        }

        $route = ($this->routePrefix ? $this->routePrefix.'.' : '') . 'products.index';
        return redirect()->route($route);
    }
}
