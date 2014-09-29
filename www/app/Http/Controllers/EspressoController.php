<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class EspressoController extends Controller
{
	public function index()
	{
		return view('index');
	}
}