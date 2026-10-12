<?php

namespace App\Models;

use App\Enums\Prioridad;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tarea_tabla';

    protected $fillable = [
        'name',
        'description',
        'priority',
        'status',
        'due_date',
        'proyecto_id' // Asegúrate de que este sea el nombre de tu clave foránea
    ];
    
    // Si ya tenías configurado el cast de la fecha, mantenlo:
   /* protected $casts = [
        'due_date' => 'date',
    ];*/
    

}