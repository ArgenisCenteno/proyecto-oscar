<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Atributo;

class AtributosSeeder extends Seeder
{
    public function run()
    {
        $atributos = [

            // 🧥 Ropa
            ['nombre' => 'Talla', 'tipo' => 'ropa'], // S, M, L, XL
            ['nombre' => 'Color', 'tipo' => 'ropa'],
            ['nombre' => 'Material', 'tipo' => 'ropa'],
            ['nombre' => 'Género', 'tipo' => 'ropa'], // Hombre, Mujer, Unisex

            // 📱 Teléfonos
            ['nombre' => 'Marca', 'tipo' => 'telefono'],
            ['nombre' => 'Modelo', 'tipo' => 'telefono'],
            ['nombre' => 'Capacidad de almacenamiento', 'tipo' => 'telefono'],
            ['nombre' => 'Memoria RAM', 'tipo' => 'telefono'],
            ['nombre' => 'Color', 'tipo' => 'telefono'],
            ['nombre' => 'Sistema Operativo', 'tipo' => 'telefono'],

            // 💻 Electrónica
            ['nombre' => 'Marca', 'tipo' =>'electronica'],
            ['nombre' => 'Modelo', 'tipo' =>'electronica'],
            ['nombre' => 'Peso','tipo' =>'electronica'],
            ['nombre' => 'Dimensiones', 'tipo' =>'electronica'],
            ['nombre' => 'Consumo eléctrico', 'tipo' =>'electronica'],

            // 🛠️ Servicios 
            ['nombre' => 'Modalidad', 'tipo' =>'servicios'], // Presencial / Online
            ['nombre' => 'Nivel', 'tipo' =>'servicios'], // Básico / Intermedio / Avanzado
        ];

        foreach ($atributos as $atributo) {
            Atributo::firstOrCreate(['nombre' => $atributo['nombre'], 'tipo' => $atributo['tipo']]);
        }
    }
}
