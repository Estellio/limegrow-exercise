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
        // Sessions stopped working at one point and I can't figure out why, so for now the Edit page has no authentication
        /*if(session('success')) {
            return view('edit-product', ['product' => $product]);
        }
        return redirect('/');*/

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

        $product->update($incomingFields);
        return redirect('/');
    }

    public function deleteProduct(Product $product) {
        $product->delete();
        return redirect('/');
    }

    public function filterProducts(Request $request) {
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
