<?php

namespace App\Http\Controllers;


use Log;
use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{

    public function addproduct(Request $request) {
        $incomingFields = $request->validate([
            'ean' => ['required', Rule::unique('products', 'ean')],
            'name' => 'required',
            'description' => 'required',
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'integer'],
            'category' => 'string'
        ]);

        Product::create($incomingFields);

        session()->flash('success', 'Product added successfully!');
        
        return redirect('/');
    }

    public function showProductView(Product $product) {
        return view('show-product', ['product' => $product]);
    }

    public function showEditScreen(Product $product) {
        return view('edit-product', ['product' => $product]);
    }

    public function updateProduct(Product $product, Request $request) {
        $incomingFields = $request->validate([
            'ean' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'integer']
        ]);

        //dd($incomingFields->only(['ean', 'name', 'description', 'price', 'stock']));

        $product->update($incomingFields);
        return redirect('/');
    }

    public function deleteProduct(Product $product) {
        $product->delete();
        return redirect('/');
    }
}
