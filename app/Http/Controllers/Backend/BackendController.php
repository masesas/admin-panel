<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class BackendController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $body_class = '';

        return view('backend.index', compact('body_class'));
    }
}
