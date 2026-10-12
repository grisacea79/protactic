<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyecto_tabla';

    protected $fillable = [
        'client_id',
        'name',
        'description',
        'status',
        'start_date',
        'end_date'
    ];

    // Un proyecto pertenece a un cliente específico
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'client_id');
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'proyect_id');
    }
}
