<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Sold_Controller extends Controller
{
    public function index() {
        $soldItems = DB::table('sold')->get();
        return view('dashboard', ['soldItems' => $soldItems]);
    }
}
