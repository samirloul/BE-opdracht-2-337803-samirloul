<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magazijn extends Model
{
    protected $table = 'Magazijn';
    protected $primaryKey = 'Id';
    public $timestamps = false;

    protected $fillable = [
        'ProductId',
        'VerpakkingsEenheid',
        'AantalAanwezig',
        'IsActief',
        'Opmerking',
        'DatumAangemaakt',
        'DatumGewijzigd',
    ];
}
