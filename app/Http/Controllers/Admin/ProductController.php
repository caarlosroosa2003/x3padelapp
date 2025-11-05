<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = ['Palas', 'Calzado', 'Accesorios', 'Ropa', 'Otros'];
        return view('admin.products.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'categoria' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'stock' => 'nullable|integer|min:0',
            'activo' => 'boolean',
        ]);

        // Manejar la imagen si se sube
        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('products', 'public');
        }

        $validated['activo'] = $request->has('activo');
        $validated['stock'] = $request->stock ?? 0;

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categorias = ['Palas', 'Calzado', 'Accesorios', 'Ropa', 'Otros'];
        return view('admin.products.edit', compact('product', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'categoria' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'stock' => 'nullable|integer|min:0',
            'activo' => 'boolean',
        ]);

        // Manejar la imagen si se sube una nueva
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($product->imagen && Storage::disk('public')->exists($product->imagen)) {
                Storage::disk('public')->delete($product->imagen);
            }
            $validated['imagen'] = $request->file('imagen')->store('products', 'public');
        }

        $validated['activo'] = $request->has('activo');
        $validated['stock'] = $request->stock ?? 0;

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Eliminar la imagen si existe
        if ($product->imagen && Storage::disk('public')->exists($product->imagen)) {
            Storage::disk('public')->delete($product->imagen);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}
