<?php

namespace App\Controllers;

class Client extends BaseController
{
    public function index()
    {
        $data = [
            'title' => "Home"
        ];
        return view('Client/Home', $data);
    }
}
