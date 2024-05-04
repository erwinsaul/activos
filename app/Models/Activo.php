<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion',
        'cantidad_inicial'
    ];

    protected $dates = ['created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($activo) {
            $ultimoCodigo = static::latest()->value('codigo');

            if ($ultimoCodigo) {
                $numero = intval(substr($ultimoCodigo, 2)) + 1;
                $nuevoCodigo = 'CM' . str_pad($numero, 3, '0', STR_PAD_LEFT);
            } else {
                $nuevoCodigo = 'CM001';
            }

            $activo->codigo = $nuevoCodigo;
        });
    }

    public function bajas()
    {
        return $this->hasMany(Baja::class);
    }

    public function stockActual()
    {
        $stockInicial = $this->cantidad_inicial;
        $bajas = $this->bajas()->sum('cantidad');

        return $stockInicial - $bajas;
    }
}
