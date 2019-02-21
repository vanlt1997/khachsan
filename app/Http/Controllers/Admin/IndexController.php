<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    function trangchu()
    {
        return view('admin.index');
    }
}
