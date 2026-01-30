<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Obtenemos todos los IDs de los usuarios actuales
        $userIds = User::pluck('id')->toArray();

        if (empty($userIds)) {
            $this->command->warn("No hay usuarios. Crea usuarios primero para asignarles tareas.");
            return;
        }

        // 2. Arrays de ejemplo para generar datos variados
        $titulos = [
            'Estudiar para el examen', 'Comprar víveres', 'Lavar el coche', 
            'Repasar Laravel', 'Ir al gimnasio', 'Llamar al médico', 
            'Limpiar la casa', 'Preparar la cena', 'Actualizar LinkedIn'
        ];

        $descripciones = [
            'Es prioritario para el lunes', 'Recordar comprar leche y huevos', 
            'Usar el champú especial para carrocería', 'Revisar controladores y seeders',
            'Hacer 30 minutos de cardio', 'Pedir cita para el chequeo anual'
        ];

        // 3. Creamos 50 tareas aleatorias
        for ($i = 0; $i < 50; $i++) {
            Task::create([
                'user_id'     => $userIds[array_rand($userIds)], // Usuario aleatorio
                'title'       => $titulos[array_rand($titulos)] . " " . ($i + 1),
                'description' => $descripciones[array_rand($descripciones)],
                'completed'   => rand(0, 1), // Si tu tabla tiene este campo
            ]);
        }

        $this->command->info("¡Se han creado 50 tareas con éxito!");
    }
}