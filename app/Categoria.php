<?php

namespace App;
use App\Producto;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    protected $hidden = [
        'pivot'
    ];

    public function productos()
    {
        return $this->belongsToMany(Producto::class);
    }
}
