<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Банк
 * @package App\Models
 *
 * @property string $name
 */
class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
}
