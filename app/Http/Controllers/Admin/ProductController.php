<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductsRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);

        return view('admin.products.index',
            compact('products', $products));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories', $categories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductsRequest $request)
    {
        $product = new Product();

        if ($request->hasFile('image')) {
            $storagepath = $request->file('image')->store('public/products');
            $fileName = basename($storagepath);
            $data['image'] = 'products/' . $fileName;
        }

        $data['name'] = $request->get('name');
        $data['description'] = $request->get('description');
        $data['category_id'] = $request->get('category_id');
        $data['price'] = $request->get('price');
        $data['is_active'] = $request->get('is_active');
        $data['discount'] = $request->get('discount');

        DB::beginTransaction();

        try {
            $product = Product::create(
                [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'category_id' => $data['category_id'],
                    'image' => $data['image'],
                    'price' => $data['price'],
                    'is_active' => $data['is_active'],
                    'discount' => $data['discount'],
                ]
            );

            DB::commit();
            return response()->json(['success' => 'Product added successfully.']);

        } catch (\Exception $e) {
            DB::rollback();
            $message = str_replace(array("\r", "\n", "'", "`"), ' ', $e->getMessage());
            // return $message;
            return response()->json(['error' => $message], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
