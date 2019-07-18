<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Http\Resources\Product\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
      $products = Product::latest()->paginate(6);
      return  ProductResource::collection($products);
    }
}
