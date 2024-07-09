<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [

            [
                'name'=>'Librería',
                'slug'=> Str::slug('Librería'),
                'image' => 'categories/bookshop.png',
                'icon'=>'📕'
            ],
            // [
            //      'name'=>'Tecnología',
            //      'slug'=> Str::slug('Tecnología'),
            //     'image' => 'categories/technology.png',
            //      'icon'=>'💻'
            // ],
            // [
            //     'name'=>'Fotografía',
            //     'slug'=> Str::slug('Fotografía'),
            //     'image' => 'categories/photography.png',
            //     'icon'=>'📷'
            // ],
            
            // [
            //     'name'=>'Trámites',
            //     'slug'=> Str::slug('Trámites'),
            //     'image' => 'categories/procedures.png',
            //     'icon'=>'💼'
            // ],
            // [
            //     'name'=>'Imprenta',
            //     'slug'=> Str::slug('Imprenta'),
            //     'image' => 'categories/printing.png',
            //     'icon'=>'🖨️'
            // ],
        ];

        foreach($categories as $category){
            $category = Category::factory(1)->create($category)->first();

            // $brands =Brand::factory(4)->create();
            // foreach($brands as $brand){
            //     $brand->categories()->attach($category->id);
            // }
        }
    }
}
