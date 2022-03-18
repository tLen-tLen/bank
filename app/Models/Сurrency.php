<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Валюта
 * @package App\Models
 *
 * @property string $name
 */
class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
}
