<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
   public function showHome(){
		$data['title'] = "Austin Słominski - Web Developer";
		return view('home',$data);
	}
}
