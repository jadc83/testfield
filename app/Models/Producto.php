<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Producto extends Model
{
    protected $fillable = ['denominacion', 'precio', 'fabricante_id'];

    public function fabricante(){
        return $this->belongsTo(Fabricante::class);
    }
    public function facturas(){
        return $this->BelongsToMany(Factura::class);
    }
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;
}
