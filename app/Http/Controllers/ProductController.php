<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('product.index', compact('products'));
    }

    public function fetchFromApi()
    {
        try {
            $response = Http::get('https://fakestoreapi.com/products');

            if ($response->successful()) {
                $products = $response->json();
                $newCount = 0;
                $duplicateCount = 0;

                foreach ($products as $product) {
                    // Check if product exists (including soft deleted)
                    $existingProduct = Product::where('api_id', $product['id'])
                        ->first();

                    if (!$existingProduct) {
                        // Product doesn't exist, create new
                        Product::create([
                            'api_id' => $product['id'],
                            'title' => $product['title'],
                            'price' => $product['price'],
                            'description' => $product['description'],
                            'category' => $product['category'],
                            'image' => $product['image'],
                            'rating_rate' => $product['rating']['rate'] ?? null,
                            'rating_count' => $product['rating']['count'] ?? null
                        ]);
                        $newCount++;
                    } else {
                        // Product exists (either active or deleted)
                        $duplicateCount++;
                    }
                }

                return redirect()->route('products.index')
                    ->with('success', "Fetched successfully! New products: {$newCount}, Duplicates skipped: {$duplicateCount}");
            }

            return redirect()->route('products.index')
                ->with('error', 'Failed to fetch products from API');
        } catch (\Exception $e) {
            return redirect()->route('products.index')
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'image' => 'required|url',
            'rating_rate' => 'nullable|numeric|min:0|max:5',
            'rating_count' => 'nullable|integer|min:0'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product->update($request->only(['title', 'price', 'description', 'category', 'image', 'rating_rate', 'rating_count']));

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully!');
    }
}
