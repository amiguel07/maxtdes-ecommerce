<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=['id','created_at','updated_at'];

    const BORRADOR = 1;
    const PUBLICADO = 2;
    //ACCESORES Tiene que empezar con get ... NombreQueLeQuieroDar ... y terminar con Attribute

    public function getStockAttribute(){
        if($this->subcategory->size){
            return ColorSize::whereHas('size.product',function(Builder $query){
                $query->where('id',$this->id);
            })->sum('quantity');
        }elseif($this->subcategory->color){
            return ColorProduct::whereHas('product',function(Builder $query){
                $query->where('id',$this->id);
            })->sum('quantity');
        }else{
            return $this->quantity;
        }
    }
    //URL Amigable
    public function getRouteKeyName()
    {
        return 'slug';
    }

    //Relacion uno a muchos
    public function sizes(){
        return $this->hasMany(Size::class);
    }

    //Relacion uno a muchos inversa
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }
    

    //Relacion de muchos a muchos
    public function colors(){
        return $this->belongsToMany(Color::class)->withPivot('quantity','id');
    }


    //Relacion uno a muchos polimorfica

    public function images(){
        return $this->morphMany(Image::class,"imageable");
    }

}
