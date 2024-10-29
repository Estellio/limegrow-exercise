<?php

namespace App\Http\Controllers;

use Log;
use session;
use Exception;
use App\Models\Product;
use App\Models\Category;
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
            'category_id' => ['required', 'integer']
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

    /*public function filterByPrice(Request $request) {
        
        // Define minimum and maximum prices
        $minPrice = $request->get('min_price', 0);
        $maxPrice = $request->get('max_price', 1000);
        
        $products = Product::whereBetween('price', [$minPrice, $maxPrice])->get();
        $categories = Category::all();
        
        return view('/home', compact('products', 'categories'));
    }

    public function filterByCategory(Request $request) {

        $category_id = $request->get('category_id');
        $categories = Category::all();

        // Filter products by category
        $products = Product::when($category_id, function($query) use ($category_id) {
            return $query->where('category_id', $category_id);
        })->get();

        return view('/home', compact('products', 'categories'));
    }*/

    public function filter(Request $request) {
        $categories = Category::all();
        $query = Product::query();
    
        // Filter by category if selected
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
    
        // Filter by price range if set
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
    
        $products = $query->get();
    
        return view('/home', compact('categories', 'products'));
    }
}
