<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos);
    }

    // Mostrar un producto específico
    public function show($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['mensaje' => 'Producto no encontrado'], 404);
        }

        return response()->json($producto);
    }

    // Crear un nuevo producto
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'codigo' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required',
            'categoria' => 'required|in:calzado,ropa,joyería',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $producto = Producto::create($validatedData);

        return response()->json($producto, 201);
    }

    // Actualizar un producto existente
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['mensaje' => 'Producto no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'codigo' => 'sometimes|required|string|max:255',
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion' => 'sometimes|required',
            'categoria' => 'sometimes|required|in:calzado,ropa,joyería',
            'precio' => 'sometimes|required|numeric',
            'stock' => 'sometimes|required|integer',
        ]);

        $producto->update($validatedData);

        return response()->json($producto);
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['mensaje' => 'Producto no encontrado'], 404);
        }

        $producto->delete();

        return response()->json(['mensaje' => 'Producto eliminado correctamente']);
    }
}
