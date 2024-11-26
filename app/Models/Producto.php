<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['denominacion', 'precio', 'fabricante_id'];
    public function fabricante(){
        return $this->belongsTo(Fabricante::class);
    }
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;
}
