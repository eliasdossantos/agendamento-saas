<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        $this->view('home.index', ['title' => 'Início'], 'home');
    }
}
