<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::all();
        return view('dash.products.all', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryname = Category::all(['id', 'name']);
        return view('dash.products.add', compact('categoryname'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'price' => 'required',
            'category_id' => 'nullable',
            'image' => 'image|mimes:png,jpg,svg,jpeg|max:2048',
        ]);


        $requested_data = $request->except('image');
        if ($request->file('image')) {

            $imgname = uniqid() . $request->file('image')->getClientOriginalName();
            Image::make($request->file('image'))->resize(215, 272, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/product/' . $imgname));
            $requested_data['image'] = $imgname;
        }
        Product::create($requested_data);
        return to_route('dashboard.products.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categoryname = Category::all(['id', 'name']);
        return view('dash.products.edit', compact('product', 'categoryname'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    { {
            $request->validate([
                'name_ar' => 'required|string',
                'name_en' => 'required|string',
                'description_ar' => 'required|string',
                'description_en' => 'required|string',
                'price' => 'required',
                'category_id' => 'nullable',
                'image' => 'image|mimes:png,jpg,svg,jpeg|max:2048',
            ]);


            $requested_data = $request->except('image');
            if ($request->file('image')) {
                if ($product->image != 'default-product.png') {
                    unlink(public_path('uploads/product/' . $product->image));
                }

                $imgname = uniqid() . $request->file('image')->getClientOriginalName();
                Image::make($request->file('image'))->resize(215, 272, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/product/' . $imgname));
                $requested_data['image'] = $imgname;
            }
            Product::create($requested_data);
            return to_route('dashboard.products.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image != 'default-product.png') {
            unlink(public_path('uploads/product/' . $product->image));
        };
        $product->delete();
        return to_route('dashboard.products.index');
    }
}
