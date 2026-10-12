<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Tarea;
use Carbon\Carbon;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Trae los clientes junto con sus proyectos en una sola consulta estructurada
    $clientes = Cliente::with('proyectos')->get(); 
    
    //return view('cliente.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::where('status', 'activo')->get();
        return view('proyectos.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id'   => 'required|exists:cliente_tabla,id',
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'status'      => 'required|string',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
        ]);

        Proyecto::create($request->all());

        return redirect()->route('cliente.index')->with('success', 'Proyecto creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proyecto = Proyecto::with('cliente')->findOrFail($id);
    
    return view('proyectos.show', compact('proyecto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $proyecto = Proyecto::findOrFail($id);
    
    // Traemos todos los clientes para que puedan cambiar de dueño si es necesario
    $clientes = Cliente::all(); 
    
    return view('proyectos.edit', compact('proyecto', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $request->validate([
        'client_id'   => 'required|exists:cliente_tabla,id',
        'name'        => 'required|string|max:255',
        'description' => 'required|string',
        'status'      => 'required|string',
        'start_date'  => 'required|date',
        'end_date'    => 'required|date|after_or_equal:start_date',
    ]);

    $proyecto = Proyecto::findOrFail($id);
    $proyecto->update($request->all());

    return redirect()->route('cliente.index')->with('success', 'Proyecto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $proyecto = Proyecto::findOrFail($id);
       $proyecto->delete();
        return redirect()->route('cliente.index')->with('success', 'Proyecto eliminado correctamente.');
    }

  


}
