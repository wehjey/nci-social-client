<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\APIService;


class HomeController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }
}
