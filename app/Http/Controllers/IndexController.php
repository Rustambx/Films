<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index ()
    {
        $this->title = 'Index';
        $this->view('index');

        return $this->render();
    }
}
