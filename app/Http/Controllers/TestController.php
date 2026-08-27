<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function welcome()
    {
        return "worked";
    }

    public function hi($name = "user")
    {
        return "hi $name";
    }
}
