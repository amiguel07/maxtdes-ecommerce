<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Storage::deleteDirectory('categories');
        // Storage::makeDirectory('categories'); //Como hemos definido public en file system lo creara ahí
        Storage::deleteDirectory('subcategories');
        Storage::makeDirectory('subcategories');
        // Storage::deleteDirectory('products');
        // Storage::makeDirectory('products');
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SubcategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(ColorProductSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(ColorSizeSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(CarouselSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(ImageSeeder::class);
    }
}
