<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model
{
    use HasFactory;

    // Relación con los pedidos
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_usuario');
    }

    /**
     * Scope para buscar usuarios por letra (solo letras, sin símbolos ni números).
     
     
     **/
     public function scopeBuscarPorLetra($query, $letra)
    {
        // Buscamos la letra 'r' (sin importar mayúsculas o minúsculas)
        return $query->where('nombre', 'like', '%' . strtolower($letra) . '%');
    }


    
    

}
