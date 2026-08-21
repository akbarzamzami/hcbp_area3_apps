<?php

namespace App\Http\Controllers;

use App\Models\KmContent;
use Illuminate\Http\Request;

class KmContentController extends Controller
{
    public function index()
    {
        $contents = KmContent::all();
        return view('admin-master.km-content', compact('contents'));
    }
}
