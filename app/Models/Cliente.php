<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "cliente_tabla";
    protected $fillable = [
        'name',
        'email',
        'phone',
        'status'
    ];
    
     public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'client_id');
    }
}
