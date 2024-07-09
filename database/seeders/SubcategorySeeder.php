<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategories = [
            //1
            // [
            //     'category_id'=>1,
            //     'name'=>'Diseño web',
            //     'slug'=> Str::slug('Diseño web'),
            // ],
            // [
            //     'category_id'=>1,
            //     'name'=>'Desarrollo móvil',
            //     'slug'=> Str::slug('Desarrollo móvil')
            // ],
            //2
            // [
            //     'category_id'=>2,
            //     'name'=>'Fotografía digital',
            //     'slug'=> Str::slug('Fotografía digital')
            // ],
            // [
            //     'category_id'=>2,
            //     'name'=>'Edición de fotos',
            //     'slug'=> Str::slug('Edición de fotos')
            // ],
            // [
            //     'category_id'=>2,
            //     'name'=>'Fotografía de retrato',
            //     'slug'=> Str::slug('Fotografía de retrato')
            // ],
            //3
            [
                'category_id'=>1,
                'name'=>'Útiles escolares',
                'slug'=> Str::slug('Útiles escolares')
            ],
            //4
            // [
            //     'category_id'=>4,
            //     'name'=>'Virtuales',
            //     'slug'=> Str::slug('Virtuales')
            // ],
            // [
            //     'category_id'=>4,
            //     'name'=>'Físicos',
            //     'slug'=> Str::slug('Físicos')
            // ],
            //5
            // [
            //     'category_id'=>5,
            //     'name'=>'Impresión digital',
            //     'slug'=> Str::slug('Impresión digital')
            // ],
            // [
            //     'category_id'=>5,
            //     'name'=>'Impresión offset',
            //     'slug'=> Str::slug('Impresión offset')
            // ],
            // [
            //     'category_id'=>5,
            //     'name'=>'Encuadernación',
            //     'slug'=> Str::slug('Encuadernación')
            // ],
            // [
            //     'category_id'=>5,
            //     'name'=>'Impresión personalizada',
            //     'slug'=> Str::slug('Impresión personalizada')
            // ],
            
        ];

        foreach($subcategories as $subcategory){
            Subcategory::create($subcategory);
        }
    }
}
