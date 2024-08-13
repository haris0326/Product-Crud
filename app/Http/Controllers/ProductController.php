<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
class ProductController extends Controller
{
    // This method will show Product page
    public function index(){

        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('products.list', [
            'products' => $products
        ]);
    }

    // This method will show Create Product page
    public function create(){
        return view('products.create');
    }

    // This method will Store Product in db
    public function store(Request $request){

        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric'

        ];

        if($request->image != ""){
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        // here we will insert product in db
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if($request != ""){
         
        // here we will store image

        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $imageName = time(). '.' .$ext; // Unique image name 

        // Save image to products directory

        $image->move(public_path('uploads/products'), $imageName);  // Move image to products directory

        // save image name in databse
        $product->image = $imageName;
        $product->save();

        }


        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    // This method will show edit product page
    public function edit($id){

        $product = Product::findOrFail($id);
        return view('products.edit', [
            'product' => $product
        ]);

    }

    public function update($id, Request $request){

        $product = Product::findOrFail($id);

        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric'

        ];

        if($request->image != ""){
            $rules['image'] = 'image';
            
            // delete old image
            File::delete(public_path('uploads/products/' .$product->image));
        }

        // $show = File::get(public_path('uploads/products/' .$product->image));
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);
        }

        // here we will Update product in db
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if($request != ""){
         
        // here we will store image

        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $imageName = time(). '.' .$ext; // Unique image name 

        // Save image to products directory

        $image->move(public_path('uploads/products'), $imageName);  // Move image to products directory

        // save image name in databse
        $product->image = $imageName;
        $product->save();

        }


        return redirect()->route('products.index')->with('success', 'Product Updated successfully.');
    }

    public function viewProduct($id)
{
    $product = Product::findOrFail($id);

    return view('products.view', [
        'product' => $product
    ]);
}



    // This method will Delete product
    public function destroy($id){
        $product = Product::findOrFail($id);
        // delete old image
        File::delete(public_path('uploads/products/' .$product->image));

        // delete product from database
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
 