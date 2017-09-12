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

        $this->middleware('auth', [
            'except' => ['index', 'show']
        ]);

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
        $user = Auth::user();
        if ($this->routePrefix == 'user' && $user) {
            $data['products'] = $this->productService->getByUserId($user->id);
        } else {
            $data['products'] = $this->productService->getAll();
        }

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
     * @param Request $request
     * @param int $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show(Request $request, $product)
    {
        $data['product'] = $this->productService->getProduct($product);

        if ( ! $data['product'] ) {
            $request->session()->flash('status_error', 'Sorry, product not found.');
            return redirect()->route('products.index');
        }

        $data['routePrefix'] = $this->routePrefix ? $this->routePrefix.'.' : '';
        return view('products.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param int $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit(Request $request, $product)
    {
        $data['product'] = $this->productService->getProduct($product);

        if ( ! $data['product'] ) {
            $request->session()->flash('status_error', 'Sorry, product not found.');
            return redirect()->route('products.index');
        }

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
            $request->session()->flash('status_info', 'Successfully updated.');
        } else {
            $request->session()->flash('status_error', 'Product not found.');
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
            $request->session()->flash('status_info', 'Successfully deleted.');
        } else {
            $request->session()->flash('status_error', 'Cannot find this product, maybe it has already been deleted?');
        }

        $route = ($this->routePrefix ? $this->routePrefix.'.' : '') . 'products.index';
        return redirect()->route($route);
    }
}
