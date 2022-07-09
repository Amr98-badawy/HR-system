<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContracts;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
}
