<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderStoreRequest;
use App\Services\OrderService;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    private $orderService;

    public function __construct(OrderService $service) {
        $this->orderService = $service;
    }

    /**
     * Show form for create order
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        $data = [
            'form_prefix' => 'product_',
            'routePrefix' => ''
        ];
        return view('orders.create', $data);
    }

    /**
     * Save order
     *
     * @param OrderStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {dd($request);
        $result = $this->orderService->store($request->all());

        if ($result['status']) {
            Session::flash('status_info', $result['message']);
            return redirect()->route('root');
        } else {
            return back()->withErrors($result['message'])->withInput();
        }
    }
}
