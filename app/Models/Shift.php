<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shift extends Model
{
    use HasFactory;

    protected $table = 'shifts';

    protected $fillable = [
        'name',
        'from',
        'to',
        'extra_time',
        'active',
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
