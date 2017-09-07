<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Models\Product;
use App\Models\User;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    private $productService;
    private $routePrefix;

    private function getRoutePrefix($after = '') {
        $prefix = substr(Route::current()->getPrefix(), 1);
        return ($prefix ? $prefix.$after : '');
    }

    /**
     * Create new instance of ProductsController
     *
     * @param ProductService $service
     * @return void
     */
    public function __construct(ProductService $service) {
        $this->productService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->getRoutePrefix() == 'user') {
            $data['products'] = $this->productService->getByUserId(Auth::user()->id);
        } else {
            $data['products'] = $this->productService->getAll();
        }

        $data['routePrefix'] = $this->getRoutePrefix('.');
        return view('products.all', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['users'] = array_pluck(User::all()->toArray(), 'name', 'id');
        $data['routePrefix'] = $this->getRoutePrefix('.');
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

        return redirect()->route($this->getRoutePrefix('.').'products.edit', $createdProduct->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['product'] = Product::findOrFail($id);
        $data['routePrefix'] = $this->getRoutePrefix('.');
        return view('products.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['product'] = Product::findOrFail($id);
        $data['routePrefix'] = $this->getRoutePrefix('.');
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
        $this->productService->update($id, $request->all());
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productService->delete($id);
        return $this->index();
    }
}
