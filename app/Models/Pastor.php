<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pastor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'birth_date',
        'ordination_date',
        'status',
        'photo',
        'end_date',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'ordination_date' => 'date',
        'end_date' => 'date',
    ];

    public function congregations()
    {
        return $this->hasMany(Congregation::class);
    }
}
