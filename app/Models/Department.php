<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContracts;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model implements TranslatableContracts
{
    use HasFactory;
    use Translatable;

    protected $table = 'departments';

    protected $guarded = [];

    protected array $translatedAttributes = [
        'name',
    ];

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
