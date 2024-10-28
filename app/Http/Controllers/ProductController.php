<?php

namespace App\Http\Controllers;

use Log;
use session;
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
    
        // Display a success message
        session()->flash('success', 'Product added successfully!');
            
        return redirect('/');
    }

    public function showProductView(Product $product) {
        return view('show-product', ['product' => $product]);
    }

    public function showEditScreen(Product $product) {
        if(session('success')) {
            return view('edit-product', ['product' => $product]);
        }

        return redirect('/');
    }

    public function updateProduct(Product $product, Request $request) {
        $incomingFields = $request->validate([
            'ean' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'integer']
        ]);

        $product->update($incomingFields);
        return redirect('/');
    }

    public function deleteProduct(Product $product) {
        $product->delete();
        return redirect('/');
    }

    public function filterByPrice(Request $request) {

    // Define minimum and maximum prices
    $minPrice = $request->get('min_price', 0);
    $maxPrice = $request->get('max_price', 1000);

    $products = Product::whereBetween('price', [$minPrice, $maxPrice])->get();

    return view('/home', compact('products'));
}
}
