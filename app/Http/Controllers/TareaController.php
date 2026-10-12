<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Tarea;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* $request->validate([
            'proyect_id' => 'required|exists:proyecto_tabla,id',
            'name'       => 'required|string|max:255',
             'description'       => 'required|string|max:255',
            'status'     => 'required|string',
            'priority'   => 'required|string',
            'due_date'    => 'required|date'
        ]);*/

          //Tarea::create($request->all());
          $tarea = new Tarea();
    $tarea->proyect_id = $request->proyect_id;
    $tarea->name = $request->name; // Use your actual database column name here
     $tarea->description = $request->description;
    $tarea->priority = $request->priority;
    $tarea->status = $request->status;
    $tarea->due_date = $request->due_date;
    
    // This will throw a clear exception on your screen if the database rejects it
    $tarea->save();

        return redirect()->back()->with('success', 'Tarea asignada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'required|string',
        'priority'    => 'required|in:baja,media,alta',
        'status'      => 'required|in:pendiente,en_proceso,terminada',
        'due_date'    => 'required|date',
    ]);

        $tarea = Tarea::findOrFail($id);
        $proyectoId = $tarea->proyect_id; 
        //dd($tarea->toArray());

    $tarea->update([
        'name'        => $request->name,
        'description' => $request->description,
        'priority'    => $request->priority,
        'status'      => $request->status,
        'due_date'    => $request->due_date,
    ]);
      
       

    // 4. Redireccionar limpiamente usando el método GET del navegador
    return redirect()->to("/showProyect/{$proyectoId}")->with('success', 'Tarea actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            $tarea = Tarea::findOrFail($id);
    
    // Guardamos el ID del proyecto antes de borrar la tarea
    $proyectoId = $tarea->proyecto_id; 

    // Borramos la tarea de la base de datos
    $tarea->delete();

    // Redireccionamos explícitamente a la vista del proyecto
    return redirect()->to("/showProyect/{$proyectoId}")->with('success', 'Tarea eliminada.');

    }
}
