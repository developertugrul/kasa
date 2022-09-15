<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function index()
    {
        return view('home.index', ["products" => DB::table('Product')->get(), "categories" => DB::table('ProductCategory',)->get(),"vendors" => DB::table("Vendor")->get()]);
    }
}
