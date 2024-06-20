<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientPanelController extends Controller
{
    public function index()
    {
        return view('client');
    }
}
