<?php

namespace App\Enums;

enum Prioridad: int {
    case BAJA = 1;
    case MEDIA = 2;
    case ALTA = 3;

    // Método personalizado para obtener el texto limpio
    public function label(): string 
    {
        return match($this) {
            self::BAJA => 'Baja',
            self::MEDIA => 'Media',
            self::ALTA => 'Alta',
        };
    }
    public function color(): string 
{
    return match($this) {
        self::BAJA => 'bg-green-100 text-green-800',
        self::MEDIA => 'bg-yellow-100 text-yellow-800',
        self::ALTA => 'bg-red-100 text-red-800',
    };
}
}