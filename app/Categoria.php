<?php

namespace App;
use App\Producto;
use App\Transformers\CategoriaTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;
    
    public $transformer = CategoriaTransformer::class;

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
