<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            [
                'url' => 'products/Archivador de colores.png',
                'imageable_id' => 1,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/borrador1.gif',
                'imageable_id' => 2,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Borradores.png',
                'imageable_id' => 2,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/calculadora3.png',
                'imageable_id' => 3,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/chinches indicadores.png',
                'imageable_id' => 4,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/cinta3.png',
                'imageable_id' => 5,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/cinta4.png',
                'imageable_id' => 5,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/cintaq1.png',
                'imageable_id' => 5,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Cintas de Embalaje.png',
                'imageable_id' => 6,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Cola Sintetica Pegafan.png',
                'imageable_id' => 7,
                'imageable_type' => 'App\Models\Product'
            ],[
                'url' => 'products/cola_blanca.png',
                'imageable_id' => 8,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Colores.png',
                'imageable_id' => 9,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Correctores.png',
                'imageable_id' => 10,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Cuadernos con Diseño.png',
                'imageable_id' => 11,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Cuadernos SOlidos.png',
                'imageable_id' => 12,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/cuadernoss{.png',
                'imageable_id' => 11,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Dispensador Cinta1.png',
                'imageable_id' => 13,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Dispensador de Cinta.png',
                'imageable_id' => 13,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Engrapador Artesco.png',
                'imageable_id' => 14,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Engrapador1.png',
                'imageable_id' => 14,
                'imageable_type' => 'App\Models\Product'
            ],[
                'url' => 'products/EscuadraArtesco.png',
                'imageable_id' => 15,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/escuadras.png',
                'imageable_id' => 15,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Forro Artesco.png',
                'imageable_id' => 16,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Forro Vinifan.png',
                'imageable_id' => 17,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Fundas Portapapel.png',
                'imageable_id' => 18,
                'imageable_type' => 'App\Models\Product'
            ],[
                'url' => 'products/grapador.png',
                'imageable_id' => 19,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Grapas Artesco.png',
                'imageable_id' => 20,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Grapas Rapid.png',
                'imageable_id' => 21,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/img-cuadernos-secundaria.png',
                'imageable_id' => 11,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/lapiceropilot.png',
                'imageable_id' => 22,
                'imageable_type' => 'App\Models\Product'
            ],[
                'url' => 'products/Lapiceros Trilux31.png',
                'imageable_id' => 23,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Lapiceros Trilux35.png',
                'imageable_id' => 23,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Lapiceros y Escuadras.png',
                'imageable_id' => 22,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Lapiz Grafito.png',
                'imageable_id' => 24,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Marcador-fluorescente-amarillo-10.jpg',
                'imageable_id' => 25,
                'imageable_type' => 'App\Models\Product'
            ],[
                'url' => 'products/Notitas.png',
                'imageable_id' => 26,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Pegamento en Barra.png',
                'imageable_id' => 27,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Perforador Faber.png',
                'imageable_id' => 28,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Perforador.png',
                'imageable_id' => 29,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Plumon Grueso Faber.png',
                'imageable_id' => 30,
                'imageable_type' => 'App\Models\Product'
            ],[
                'url' => 'products/Plumon Pizarra Outline.png',
                'imageable_id' => 31,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Plumon Pizarra1.png',
                'imageable_id' => 32,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Plumones de Pizarra.png',
                'imageable_id' => 32,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Porta Utiles.png',
                'imageable_id' => 33,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Resaltadores.png',
                'imageable_id' => 34,
                'imageable_type' => 'App\Models\Product'
            ],[
                'url' => 'products/Saca Grapas.png',
                'imageable_id' => 35,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Saca Grapas12.png',
                'imageable_id' => 35,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Silicona Artesco.png',
                'imageable_id' => 36,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Silicona Arti.png',
                'imageable_id' => 37,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Silicona Faber.png',
                'imageable_id' => 38,
                'imageable_type' => 'App\Models\Product'
            ],[
                'url' => 'products/Silicona Ove.png',
                'imageable_id' => 39,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Silicona Vinifan.png',
                'imageable_id' => 40,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Tijeras.png',
                'imageable_id' => 41,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Tinta y Colores.png',
                'imageable_id' => 9,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'products/Vinifan y Escuadras.png',
                'imageable_id' => 15,
                'imageable_type' => 'App\Models\Product'
            ],
        ];

        foreach ($images as $image) {
            $image = Image::factory(1)->create($image)->first();
        }
    }
}
