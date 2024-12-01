<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $categoryName = $request->get('category_name');
        $brandName = $request->get('brand_name');

        $query = Product::query()
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->join('brands', 'products.brand_id', '=', 'brands.id')
                        ->select('products.*', 'categories.name as category_name', 'brands.name as brand_name');

        if ($keyword){
            $query = $query->where('products.name', 'like', "%{$keyword}%");
        }

        if ($categoryName){
            $query = $query->where('categories.name', 'like', "%{$categoryName}%");
        }

        if ($brandName){
            $query = $query->where('brands.name', 'like', "%{$brandName}%");
        }

        $products = $query->orderBy('id')->paginate(10);

        return response()->json(['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image_link' => 'required|url',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ], [
            'name.required' => 'Nama produk wajib diisi!',
            'image_link.required' => 'Link gambar wajib diisi!',
            'image_link.url' => 'Link gambar harus berupa url!',
            'price.numeric' => 'Harga harus berupa angka!',
            'price.required' => 'Harga wajib diisi!',
            'stock.integer' => 'Harga harus berupa angka!',
            'stock.required' => 'Harga wajib diisi!',
        ]);
        $product = Product::create($request->all());
        return response()->json(['message' => ' Berhasil Simpan Product', 'product' => $product]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'image_link' => 'required|url',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json(['message' => 'Berhasil Update Product!', 'product' => $product]);    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Berhasil Hapus Product!']);
    }
}
