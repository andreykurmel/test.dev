<?php

namespace App\Http\Controllers;

use App\Models\CompanyInformation;
use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function index() {
    	return view('mainPage');
    }

    public function welcome() {
	    return view('welcome');
	}

	public function contacts() {
		$info = CompanyInformation::all()->first();
		return view('contacts', compact('info'));
	}
}
