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
            'category' => 'required'
        ]);

        Product::create($incomingFields);

        session()->flash('success', 'Product added successfully!');
        
        return redirect('/');
    }

    public function showProductView(Product $product) {
        return view('show-product', ['product' => $product]);
    }
}
