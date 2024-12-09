<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Http\Resources\BranchCollection;
use App\Filters\BranchFilter;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Http\Resources\BranchResource;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    // Mostrar todas las sucursales
    public function index()
    {
        $branches = Branch::all(); // Obtener todas las sucursales
        return view('branches.index', compact('branches')); // Retorna la vista con la lista de sucursales
    }

    public function update(UpdateBranchRequest $request, Branch $Branch){
        $Branch->update($request->all());
    }

    // Mostrar el formulario para crear una nueva sucursal
    public function create()
    {
        return view('branches.create'); // Retorna el formulario de creación
    }

    public function Store(StoreBranchRequest $request){
        return new BranchResource(Branch::create($request->all()));
    }

    // Mostrar el formulario para editar una sucursal
    public function edit($id)
    {
        $branch = Branch::findOrFail($id); // Buscar la sucursal por su ID
        return view('branches.edit', compact('branch')); // Retorna el formulario de edición con los datos de la sucursal
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
