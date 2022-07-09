<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContracts;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends Model implements TranslatableContracts
{
    use HasFactory;
    use Translatable;

    protected $table = 'companies';

    protected $guarded = [];

    protected array $translatedAttributes = [
        'name'
    ];

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class);
    }
}
