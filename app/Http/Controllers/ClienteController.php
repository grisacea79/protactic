<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Tarea;
use Carbon\Carbon;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

  $search = $request->input('search');

    // 2. Modificar la consulta de clientes para que filtre sus proyectos por nombre si existe una búsqueda
    $clientes = Cliente::with(['proyectos' => function ($query) use ($search) {
        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }
    }])->get();


        
         $hoy = Carbon::today();

         // 2. CÁLCULOS GLOBALES PARA EL DASHBOARD
    $totalProyectos = Proyecto::count();
    
    // Proyectos terminados
    $proyectosTerminados = Proyecto::where('status', 'terminado')->count();
    
    // Tareas pendientes de toda la plataforma
    $tareasPendientes = Tarea::where('status', 'pendiente')->count();
    
    // Tareas vencidas en toda la plataforma (no terminadas y con fecha anterior a hoy)
    $tareasVencidas = Tarea::where('due_date', '<', $hoy)
                           ->where('status', '!=', 'terminada')
                           ->count();

         return view('crud.index', compact(
        'clientes', 
        'totalProyectos', 
        'proyectosTerminados', 
        'tareasPendientes', 
        'tareasVencidas'
    ));
       // return view("crud.index",compact("clientes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view("crud.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      // $validateData = $request->validated();
       //añadimos el eloquent
      //  $cliente = ClienteController::create($validateData);
      Cliente::create($request->all());
        return redirect()->route('cliente.index')
            ->with('success', '¡Cliente creado exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view("crud.show", compact("cliente"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view("crud.edit", compact("cliente"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $cliente = Cliente::findOrFail($id);
         $cliente->update($request->all());
         return redirect()->route("cliente.index")->with('success', 'Cliente actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente ->delete();

        return redirect()->route("cliente.index")->with('success','Cliente eliminado exitosamente.');
    }

    


}
