<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded=[];

    //URL Amigable
    public function getRouteKeyName()
    {
        return 'slug';
    }
    //Relacion uno a muchos
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
    //relacion muchos a muchos
    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }
    //Relacion a traves de Category->SubCategory->Product
    // public function products(){
    //     return $this->hasManyThrough(Product::class,Subcategory::class);
    // }

    // public function products() {
    //     return $this->hasMany(Product::class);
    // }
}
