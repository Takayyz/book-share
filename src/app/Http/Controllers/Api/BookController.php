<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    //
    public function index()
    {
        return response()->json(['apple' => 'red', 'peach' => 'pink']);
    }
}
