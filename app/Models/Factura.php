<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{

    protected $fillable = ['user_id'];

    public function productos(){
        return $this->belongsToMany(Producto::class);
    }

    public function usuario(){
        return $this->belongsTo(User::class);
    }
    /** @use HasFactory<\Database\Factories\FacturaFactory> */
    use HasFactory;
}
