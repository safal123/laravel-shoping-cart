<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\Product\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
      $products = Product::latest()->paginate(6);
      return  ProductResource::collection($products);
    }
}
