<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear 5 usuarios, cada uno con 3 pedidos
        Usuario::factory(5)
            ->hasPedidos(3) // Genera 3 pedidos por usuario
            ->create();
    }
}
