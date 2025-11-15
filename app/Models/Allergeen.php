<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allergeen extends Model
{
    protected $table = 'Allergeen';
    protected $primaryKey = 'Id';
    public $timestamps = false;

    protected $fillable = [
        'Naam',
        'Omschrijving',
        'IsActief',
        'Opmerking',
        'DatumAangemaakt',
        'DatumGewijzigd',
    ];
}
