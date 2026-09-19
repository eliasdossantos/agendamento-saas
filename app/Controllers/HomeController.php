<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Meus Agendamentos',
        ];

        $this->view(
            'front.home.index',
            $data,
            'home'
        );
    }
}
