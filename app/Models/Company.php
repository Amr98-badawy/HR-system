<?php

namespace App\Models;

use App\Traits\SetSlugTrait;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContracts;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model implements TranslatableContracts
{
    use HasFactory;
    use SetSlugTrait;
    use Translatable;

    protected $table = 'companies';

    protected $guarded = [];

    protected array $translatedAttributes = [
        'name'
    ];
}
