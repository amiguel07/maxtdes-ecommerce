<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $guarded=['id','created_at','updated_at'];
    //Relacion de uno a muchos inversa
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //Relacion de muchos a muchos
    public function colors(){
        return $this->belongsToMany(Color::class)->withPivot('quantity','id');;
    }

}
