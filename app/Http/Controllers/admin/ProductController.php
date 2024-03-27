<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Size;
use App\Http\Requests\ProductRequest;
class ProductController extends Controller
{
    //
    public function index(){
        $products = Product::join('categories', 'products.category_id', 'categories.category_id')
        ->select(
            'products.product_id',
            'products.product_name',
            'products.product_price',
            'categories.category_name',
            'products.product_quantity'
        )->paginate(10);
        return view('admin.product.index', compact('products'));
    }
    public function create(){
        $categories = Category::all(); 
        $products = Product::all(); 
        $sizes = Size::all(); 
        return view('admin.product.create', compact('categories', 'products', 'sizes'));
    }
    public function store(ProductRequest $request){
        $image = $request->file('product_image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        Product::query()->create([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'product_price' => $request->product_price,
            'product_discount' => $request->product_discount,
            'product_image' => $new_name,
            'product_color' => $request->product_color,
            'product_size' => $request->product_size,
            'product_quantity' => $request->product_quantity,
            'product_description' => $request->product_description,
        ]);
        return redirect()->route('product.index');
    }
    public function show($id){
        $products = Product::findOrFail($id);
        $products->get();
        $category_id = $products->category_id;
        $category = Category::findOrFail($category_id);
        return view('admin.product.detail', compact('products', 'category'));
    }
    public function edit(Product $product){
        $categories = Category::all();
        return view('admin.product.edit', compact('categories', 'product'));
    }
    public function update(Product $product, ProductRequest $request){
        $image_name = $request->hidden_image;
        $image = $request->file('product_image');
        if($image != ''){
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
        }
        $form_data = array(
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'product_price' => $request->product_price,
            'product_discount' => $request->product_discount,
            'product_image' => $image_name,
            'product_place' => $request->product_place,
            'product_vehicle' => $request->product_vehicle,
            'product_locationStart' => $request->product_locationStart,
            'product_locationEnd' => $request->product_locationEnd,
            'product_quantytiDate' => $request->product_quantytiDate,
            'product_dateStart' => $request->product_dateStart,
            'product_dateEnd' => $request->product_dateEnd,
            'product_description' => $request->product_description,
            'product_trip' => $request->product_trip,
            'productGuide_id' => $request->productGuide_id
        );
        
        $product->update($form_data);
        return redirect()->route('product.index');
    }
    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('product.index');
    }
}
