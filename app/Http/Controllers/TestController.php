<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class TestController extends Controller
{
    public function index()
    {
        $products = Product::findOrFail(4);

        dd($products->tag);
    }
}
