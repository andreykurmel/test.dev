<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Search user via ajax request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxSearch(Request $request) {
        $data = ['results' => []];
        if ($request->has('q')) {
            $search = $request->q;
            $data['results'] = User::where('name', 'LIKE', "%$search%")->limit(5)->get(['id', 'name as text']);
        }
        return response()->json($data);
    }
}
