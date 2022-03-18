<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Клиент
 * @package App\Models
 *
 * @property string $name
 * @property string $phone
 * @property string $email
 */
class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email'
    ];
}
