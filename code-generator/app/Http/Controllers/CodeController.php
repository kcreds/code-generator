<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function index()
    {
        return view('codes.index');
    }

    public function createCode()
    {
        return view('codes.create');
    }

    public function deleteCode()
    {
        return view('codes.delete');
    }
}
