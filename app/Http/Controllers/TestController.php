<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function view;

class TestController extends Controller
{
    public function test()
    {
        return view('test');
    }
}
