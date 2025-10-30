<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pista;

class PistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pistas = [
            [
                'nombre' => 'Pista 1',
                'descripcion' => 'Pista exterior con excelente iluminación. Ideal para partidos diurnos y nocturnos.',
                'tipo' => 'exterior',
                'disponible' => true,
                'imagen' => null,
            ],
            [
                'nombre' => 'Pista 2',
                'descripcion' => 'Pista exterior de alta calidad con césped artificial premium.',
                'tipo' => 'exterior',
                'disponible' => true,
                'imagen' => null,
            ],
            [
                'nombre' => 'Pista 3',
                'descripcion' => 'Pista cubierta climatizada. Perfecta para jugar en cualquier época del año.',
                'tipo' => 'cubierta',
                'disponible' => true,
                'imagen' => null,
            ],
            [
                'nombre' => 'Pista 4',
                'descripcion' => 'Pista exterior panorámica con vistas espectaculares.',
                'tipo' => 'exterior',
                'disponible' => true,
                'imagen' => null,
            ],
        ];

        foreach ($pistas as $pista) {
            Pista::create($pista);
        }
        
        $this->command->info('✅ 4 pistas creadas exitosamente.');
    }
}
