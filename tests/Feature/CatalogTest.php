<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalogo_carga_con_200(): void
    {
        $this->seed(\Database\Seeders\ProductSeeder::class);
        $response = $this->get('/catalogo');
        $response->assertStatus(200);
        $response->assertSee('Catálogo de Productos');
    }

    public function test_catalogo_muestra_productos_sembrados(): void
    {
        $this->seed(\Database\Seeders\ProductSeeder::class);
        $response = $this->get('/catalogo');
        $response->assertSee('Pala Profesional X3 Pro');
        $response->assertSee('Pala Intermedia X3 Sport');
    }
}


