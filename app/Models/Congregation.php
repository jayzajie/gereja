<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Congregation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'pastor_id',
        'status',
    ];

    public function pastor()
    {
        return $this->belongsTo(Pastor::class);
    }
} 