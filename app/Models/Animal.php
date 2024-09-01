<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    /**
     * @var array<string, mixed>
     */
    protected $casts = [
        'birthdate' => 'immutable_datetime',
    ];
}
