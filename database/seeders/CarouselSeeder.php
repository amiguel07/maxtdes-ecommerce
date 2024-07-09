<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carousel;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Carousel::truncate();

        Carousel::create([
            'image' => 'imagen1.jpg',
            'name' => 'Variedad de suministros',
            'desc' => 'Descubre nuestra amplia gama de suministros empresariales, desde material de oficina hasta productos tecnológicos de vanguardia',
        ]);

        Carousel::create([
            'image' => 'imagen2.jpg',
            'name' => 'Servicio al cliente excepcional',
            'desc' => 'En Maxtdes, nos comprometemos a proporcionar un servicio al cliente excepcional, brindándote asistencia personalizada y soluciones rápidas',
        ]);

        Carousel::create([
            'image' => 'imagen3.jpg',
            'name' => 'Innovación en suministros',
            'desc' => 'Maxtdes impulsa la eficiencia y el rendimiento empresarial con productos innovadores. Sé parte de la vanguardia hacia el éxito',
        ]);

        $this->command->info('Carousel table seeded!');
    }
}
