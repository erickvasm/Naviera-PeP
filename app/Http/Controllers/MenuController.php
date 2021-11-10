<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    
    public function mostrarMenu() {
    	return View("menu.principal");
    }

}
