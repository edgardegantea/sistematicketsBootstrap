<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class FrontendController extends BaseController
{
    public function index()
    {
        return view('frontend/dashboard/index');
    }
}
