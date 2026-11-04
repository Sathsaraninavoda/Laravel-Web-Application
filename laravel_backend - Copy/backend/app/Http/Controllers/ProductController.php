<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get available images from assets directory
        $assetsPath = public_path('assets');
        $images = [];
        
        if (File::exists($assetsPath)) {
            $files = File::files($assetsPath);
            foreach ($files as $file) {
                $extension = strtolower($file->getExtension());
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $images[] = $file->getFilename();
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Create form data',
            'product_code' => Product::generateProductCode(),
            'available_images' => $images
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'min_stock_level' => 'nullable|integer|min:0',
            'image_path' => 'nullable|string',
            'sku' => 'nullable|string|max:255|unique:products',
            'status' => 'nullable|in:active,inactive,out_of_stock',
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|string|max:255',
            'tags' => 'nullable|string',
            'featured' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $product = Product::create([
            'product_code' => Product::generateProductCode(),
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'price' => $request->price,
            'cost_price' => $request->cost_price,
            'stock_quantity' => $request->stock_quantity,
            'min_stock_level' => $request->min_stock_level ?? 5,
            'image_path' => $request->image_path,
            'sku' => $request->sku,
            'status' => $request->status ?? 'active',
            'weight' => $request->weight,
            'dimensions' => $request->dimensions,
            'tags' => $request->tags,
            'featured' => $request->featured ?? false
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        // Get available images from assets directory
        $assetsPath = public_path('assets');
        $images = [];
        
        if (File::exists($assetsPath)) {
            $files = File::files($assetsPath);
            foreach ($files as $file) {
                $extension = strtolower($file->getExtension());
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $images[] = $file->getFilename();
                }
            }
        }

        return response()->json([
            'success' => true,
            'data' => $product,
            'available_images' => $images
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'min_stock_level' => 'nullable|integer|min:0',
            'image_path' => 'nullable|string',
            'sku' => 'nullable|string|max:255|unique:products,sku,' . $id,
            'status' => 'nullable|in:active,inactive,out_of_stock',
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|string|max:255',
            'tags' => 'nullable|string',
            'featured' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'price' => $request->price,
            'cost_price' => $request->cost_price,
            'stock_quantity' => $request->stock_quantity,
            'min_stock_level' => $request->min_stock_level ?? $product->min_stock_level,
            'image_path' => $request->image_path,
            'sku' => $request->sku,
            'status' => $request->status ?? $product->status,
            'weight' => $request->weight,
            'dimensions' => $request->dimensions,
            'tags' => $request->tags,
            'featured' => $request->featured ?? $product->featured
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data' => $product->fresh()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ]);
    }

    /**
     * Get available images from assets directory
     */
    public function getAvailableImages()
    {
        $assetsPath = public_path('assets');
        $images = [];
        
        if (File::exists($assetsPath)) {
            $files = File::files($assetsPath);
            foreach ($files as $file) {
                $extension = strtolower($file->getExtension());
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $images[] = [
                        'filename' => $file->getFilename(),
                        'url' => asset('assets/' . $file->getFilename())
                    ];
                }
            }
        }

        return response()->json([
            'success' => true,
            'images' => $images
        ]);
    }

    /**
     * Alias kept for the existing products-images route.
     */
    public function getImages()
    {
        return $this->getAvailableImages();
    }
}
