<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
    protected $fillable = ['nombre'];
    public function productos(){
        return $this->hasMany(Producto::class);
    }
    /** @use HasFactory<\Database\Factories\FabricanteFactory> */
    use HasFactory;
}
