<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Pedido;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // Obtener todos los pedidos de un usuario específico
    public function pedidosPorUsuario($id)
    {
        return Usuario::with('pedidos')->findOrFail($id);
    }

    // Obtener todos los pedidos con detalles del usuario
    public function pedidosConUsuarios()
    {
        return Pedido::with('usuario')->get();
    }

    // Buscar usuarios por letra (solo alfabéticas, sin símbolos ni números)
    public function buscarUsuariosPorLetra(Request $request)
    {
        $letra = $request->get('letra'); // Recibir la letra desde la petición

        // Validamos si la letra ingresada es 'r', si no es 'r', no devolvemos resultados
        if (!$letra || strtolower($letra) !== 'r') {
            return response()->json(['message' => 'No hay nombres accesibles para esta letra'], 404);
        }

        // Realizamos la búsqueda de usuarios que contengan la letra 'r' en su nombre
        $usuarios = Usuario::buscarPorLetra($letra)->get();

        // Verificamos si no hay resultados
        if ($usuarios->isEmpty()) {
            return response()->json(['message' => 'No se encontraron usuarios con la letra r'], 404);
        }

        // Si hay resultados, los regresamos
        return response()->json($usuarios);
    }

    public function pedidosConUsuariosOrdenados()
    {
        // Obtener todos los pedidos junto con los usuarios, ordenados por el total de forma descendente
        $pedidos = Pedido::with('usuario')
            ->orderBy('total', 'desc') // Ordenar por el total del pedido en forma descendente
            ->get();
        
        return response()->json($pedidos);
    }

    public function sumaTotalPedidos()
    {
        $sumaTotal = Pedido::sum('total');
        return response()->json(['suma_total' => $sumaTotal]);
    }
    
    public function pedidoMasEconomico()
    {
        // Obtener el pedido más económico
        $pedidoMasEconomico = Pedido::with('usuario')
            ->orderBy('total', 'asc') // Ordenar por el total de forma ascendente
            ->first(); // Obtener el primero (el más económico)
    
        // Verificar si se encontró el pedido más económico
        if ($pedidoMasEconomico) {
            // Obtener el nombre del usuario asociado al pedido más económico
            $nombreUsuario = $pedidoMasEconomico->usuario->nombre;
            return response()->json([
                'pedido_mas_economico' => $pedidoMasEconomico,
                'nombre_usuario' => $nombreUsuario,
            ]);
        } else {
            // Si no se encontró ningún pedido, retornar un mensaje
            return response()->json(['message' => 'No se encontraron pedidos.'], 404);
        }
    }
    
    public function pedidosPorUsuarioAgrupados()
    {
            // Obtener los pedidos agrupados por usuario
            $pedidosAgrupados = Usuario::with(['pedidos' => function ($query) {
                $query->select('producto', 'cantidad', 'total'); // Seleccionar solo los campos necesarios
            }])->get();

            // Retornar los pedidos agrupados por usuario
            return response()->json($pedidosAgrupados);
    }







    
    
}
