<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Http\Resources\BranchCollection;
use App\Filters\BranchFilter;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    // Mostrar todas las sucursales
    public function index()
    {
        $branches = Branch::all(); // Obtener todas las sucursales
        return view('branches.index', compact('branches')); // Retorna la vista con la lista de sucursales
    }

    // Mostrar el formulario para crear una nueva sucursal
    public function create()
    {
        return view('branches.create'); // Retorna el formulario de creación
    }

    // Almacenar una nueva sucursal en la base de datos
    public function store(Request $request)
    {
        // Validación de datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
        ]);

        // Crear la nueva sucursal
        Branch::create($validated);

        return redirect()->route('branches.index')->with('success', 'Branch created successfully.');
    }

    // Mostrar el formulario para editar una sucursal
    public function edit($id)
    {
        $branch = Branch::findOrFail($id); // Buscar la sucursal por su ID
        return view('branches.edit', compact('branch')); // Retorna el formulario de edición con los datos de la sucursal
    }

    // Actualizar la información de una sucursal
    public function update(Request $request, $id)
    {
        // Validación de datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
        ]);

        $branch = Branch::findOrFail($id); // Buscar la sucursal por su ID
        $branch->update($validated); // Actualizar los datos

        return redirect()->route('branches.index')->with('success', 'Branch updated successfully.');
    }

    // Eliminar una sucursal
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id); // Buscar la sucursal por su ID
        $branch->delete(); // Eliminar la sucursal

        return redirect()->route('branches.index')->with('success', 'Branch deleted successfully.');
    }

    public function apiIndex(Request $request){
        $filter = new BranchFilter();
        $queryItems = $filter->transform($request);
        $includeRoutes = request()->query('includeRoutes');
        $Branches = Branch::where($queryItems);
        if($includeRoutes){
            $Branches = $Branches->with('routes');
        }
        return new BranchCollection($Branches->paginate()->appends($request->query()));
    }
}
