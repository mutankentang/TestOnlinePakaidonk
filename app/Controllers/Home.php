<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;

class Home extends ResourceController
{
    protected $format = 'json';

    public function index(){
        return view("welcome_message");
    }
}
